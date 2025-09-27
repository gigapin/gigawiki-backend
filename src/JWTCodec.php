<?php

namespace Src;

use http\Exception\InvalidArgumentException;

class JWTCodec
{
  public function encode(array $payload): string
  {
    $header = json_encode([
      "typ" => "JWT",
      "alg" => "HS256"
    ]);

    $header = $this->base64UrlEncode($header);

    $payload = $this->base64UrlEncode(json_encode($payload));

    $signature = hash_hmac(
      'sha256', $header . '.' . $payload,
      $_ENV['APP_KEY'],
      true
    );
    $signature = $this->base64UrlEncode($signature);

    return $header . '.' . $payload . '.' . $signature;
  }

  public function decode(string $token): array
  {
    if (preg_match("/^(?<header>.*)\.(?<payload>.*)\.(?<signature>.*)$/", $token, $matches) !== 1) {
      throw new InvalidArgumentException('Token not valid');
    }

    $signature = hash_hmac(
      'sha256', $matches['header'] . '.' . $matches['payload'],
      $_ENV['APP_KEY'],
      true
    );
    $signature_from_token = $this->base64UrlDecode($matches['signature']);

    if (! hash_equals($signature, $signature_from_token)) {
      throw new InvalidArgumentException("Signature doesn't match");
    }

    return json_decode($this->base64UrlDecode($matches['payload']), true);
  }

  private function base64UrlEncode(string $data): string
  {
    return str_replace(
      ['+', '/', '='],
      ['-', '_', ''],
      base64_encode($data)
    );
  }

  private function base64UrlDecode(string $data): string
  {
    return base64_decode(str_replace(
      ['-', '_'],
      ['+', '/'],
      $data
    ));
  }
}
