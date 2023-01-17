<?php

declare(strict_types=1);

namespace Falcon\CustomChanges\Plugin;

use Magento\Elasticsearch\SearchAdapter\Query\Builder\Match;
use Magento\Framework\Search\Request\QueryInterface as RequestQueryInterface;


/**
 * class for search product through sku
 */
class AfterBuild extends Match
{

    /**
     * @param Match $subject
     * @param array $result
     * @param array $selectQuery
     * @param RequestQueryInterface $requestQuery
     * @param $conditionType
     * @return array
     */
    public function afterBuild(
        Match $subject,
        array $result,
        array $selectQuery,
        RequestQueryInterface $requestQuery,
        $conditionType
    ) {
        $queryValue = $this->prepareQuery($requestQuery->getValue(), $conditionType);
        $queries = $this->buildQueries($requestQuery->getMatches(), $queryValue);
        $requestQueryBoost = $requestQuery->getBoost() ?: 1;
        foreach ($queries as $query) {
            $queryBody = $query['body'];
            $matchKey = array_keys($queryBody)[0];
            foreach ($queryBody[$matchKey] as $field => $matchQuery) {
                $matchQuery['boost'] = $requestQueryBoost + $matchQuery['boost'];
                if ($matchKey != 'match_phrase_prefix') {
                    $matchQuery['operator'] = "AND";
                }
                $queryBody[$matchKey][$field] = $matchQuery;
            }
            $selectQuery['bool'][$query['condition']][] = $queryBody;
        }

        return $selectQuery;
    }
}
