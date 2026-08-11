<?php
namespace Flownative\TokenAuthentication\Security\Repository;

use Neos\Flow\Annotations as Flow;
use Neos\Flow\Persistence\Doctrine\Repository;
use Neos\Flow\Persistence\QueryResultInterface;
use Flownative\TokenAuthentication\Security\Model\HashAndRoles;

/**
 * @method HashAndRoles|null findByIdentifier(string $identifier)
 * @method HashAndRoles|null findOneByRolesHash(string $rolesHash)
 * @method QueryResultInterface findByRolesHash(string $rolesHash)
 * @Flow\Scope("singleton")
 */
class HashAndRolesRepository extends Repository
{
    /**
     * @param array $roles
     * @return HashAndRoles|null
     */
    public function findOneByRoles(array $roles): ?HashAndRoles
    {
        return $this->findOneByRolesHash(HashAndRoles::calculateHashForRoles($roles));
    }

    /**
     * @param array $roles
     * @return QueryResultInterface
     */
    public function findByRoles(array $roles): QueryResultInterface
    {
        return $this->findByRolesHash(HashAndRoles::calculateHashForRoles($roles));
    }

    public function findOneByIdentifierAndNotExpired(string $identifier): ?HashAndRoles
    {
        $query = $this->createQuery();
        $query->matching(
            $query->logicalAnd(
                $query->equals('hash', $identifier),
                $query->logicalOr(
                    $query->equals('expiresAt', null),
                    $query->greaterThanOrEqual('expiresAt', new \DateTime('now'))
                )
            )
        );

        return $query->execute()->getFirst();
    }
}
