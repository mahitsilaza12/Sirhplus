<?php

namespace Symfony6\ParamConverter;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Sensio\Bundle\FrameworkExtraBundle\Request\ParamConverter\ParamConverterInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\UnsupportedMediaTypeHttpException;
use Symfony\Component\Serializer\SerializerInterface;

final class RequestBodyParamConverter implements ParamConverterInterface
{
    /**
     * RequestBodyParamConverter constructor.
     * @param SerializerInterface $serializer
     */
    public function __construct(private readonly SerializerInterface $serializer)
    {
    }

    /**
     * {@inheritdoc}
     *
     * @throws \Exception
     */
    public function apply(Request $request, ParamConverter $configuration): bool
    {
        $format = $request->getContentType();

        if (null === $format) {
            return $this->throwException(new UnsupportedMediaTypeHttpException(), $configuration);
        }

        $object = $this->serializer->deserialize(
            $request->getContent(),
            $configuration->getClass(),
            $format
        );

        $request->attributes->set($configuration->getName(), $object);

        return true;
    }

    /**
     * {@inheritdoc}
     */
    public function supports(ParamConverter $configuration): bool
    {
        return null !== $configuration->getClass() && 'request_body_converter' === $configuration->getConverter();
    }

    /**
     * @throws \Exception
     */
    private function throwException(\Exception $exception, ParamConverter $configuration): bool
    {
        if ($configuration->isOptional()) {
            return false;
        }

        throw $exception;
    }
}
