<?php

namespace Symfony6\Entity;

use Doctrine\ORM\Mapping as ORM;
use Gesdinet\JWTRefreshTokenBundle\Entity\RefreshToken;

#[ORM\Table(name: "jwt_refresh_token")]
class JwtRefreshToken extends RefreshToken
{
}