# Token based authentication for Neos Flow projects

This package provides token based authentication for Neos Flow projects. It
allows both sessionless and session-based authentication to be used.

## Installation

Run:
```shell
composer require flownative/token-authentication
```

## Usage

### Create a token

Run:
```shell
./flow hashtoken:createhashtoken --roleNames Neos.Neos:Editor
```

Arguments:

| Argument  | Required | Description                                                 |
|-----------|----------|-------------------------------------------------------------|
| roleNames | YES      | The roles with which the token is authenticated             |
| label     |          | Custom Label for this token                                 |
| expiresAt |          | Set an expiration date from which the token becomes invalid |


### Authenticate with a token

Provide the token in your requests

- as request argument `_authenticationHashToken=<myToken>` or
- as `Authorization` header with the value `Bearer <myToken>`.

## Configuration

The configuration is done as usual in the `Configuration/Settings.yaml` file.

```yaml
Neos:
  Flow:
    security:
      authentication:
        providers:
          'Acme.Com:TokenAuthenticator':
            provider: Flownative\TokenAuthentication\Security\HashTokenProvider
            requestPatterns:
              'Acme.Com:Controllers':
                pattern: ControllerObjectName
                patternOptions:
                  controllerObjectNamePattern: 'Acme\Com\Controller\.*'
```

By default the package uses a sessionless token. If you want to use a
session-based token, set the `token` option in the provider configuration:

```yaml
providers:
  'Acme.Com:TokenAuthenticator':
    provider: Flownative\TokenAuthentication\Security\HashTokenProvider
    token: Flownative\TokenAuthentication\Security\SessionStartingHashToken
```
