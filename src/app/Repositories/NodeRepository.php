<?php

namespace Api\Repositories;

use Api\Database\DatabaseInterface;
use Api\Exceptions\RecordNotFoundException;
use Api\Factories\NodeFactory;

class NodeRepository implements RepositoryInterface
{
    /**
     * @var mixed
     */
    private $db;


    /**
     * Returns an array of node objects
     *
     * @param array $queryResult
     * @return array
     */
    private function prepareDataForApi(array $queryResult)
    {
        $nodes = [];

        foreach ($queryResult as $node)
        {
            $nodes[] = NodeFactory::build($node);
        }

        return $nodes;
    }


    /**
     * Checks if node with given id exists
     *
     * @param int $idNode
     * @return mixed
     */
    private function exists(int $idNode)
    {
        $sql = "
            SELECT
                COUNT(*) AS tot
            FROM
                node_tree
            WHERE
                idNode = :idNode
            LIMIT 1
        ";

        $queryDB = $this->db->prepare($sql);

        $queryDB->bindParam(':idNode', $idNode, \PDO::PARAM_INT);

        if (!$queryDB->execute())
        {
            throw new \PDOException();
        }

        return $queryDB->fetch(\PDO::FETCH_OBJ)->tot;
    }


    /**
     * NodeRepository constructor.
     *
     * @param DatabaseInterface $db
     */
    public function __construct(DatabaseInterface $db)
    {
        $this->db = $db->getConnection();
    }


    /**
     * Logic for retrieving data
     *
     * @param array $requestData
     * @return array|mixed
     * @throws RecordNotFoundException
     */
    public function find(array $requestData)
    {
        if (!$this->exists($requestData['node_id']))
        {
            throw new RecordNotFoundException();
        }

        $defaultValues = [
            'search_keyword' => '',
            'page_num' => 0,
            'page_size' => 100
        ];

        $mergedData = array_merge($defaultValues, $requestData);

        $sql = "
            SELECT
            subTree.idNode, subTree.nodes, node_tree_names.nodeName
            FROM
            (
                SELECT
                   node.idNode,
                   ROUND ((node.iRight - node.iLeft - 1) / 2) AS nodes
                FROM
                   node_tree AS node, node_tree AS root
                WHERE
                   node.level = root.level + 1
                   AND node.iLeft > root.iLeft
                   AND node.iRight < root.iRight
                   AND root.iLeft = (SELECT iLeft FROM node_tree WHERE idNode = :node_id)
            )  AS subTree
            INNER JOIN
            node_tree_names
            ON node_tree_names.idNode = subTree.idNode
            AND node_tree_names.language = :language
            WHERE 
                  node_tree_names.nodeName COLLATE utf8mb4_general_ci LIKE CONCAT(:search_keyword, '%')
            LIMIT :page_num, :page_size;
            ";

        $queryDB = $this->db->prepare($sql);

        $queryDB->bindParam(':node_id', $mergedData['node_id'], \PDO::PARAM_INT);
        $queryDB->bindParam(':language', $mergedData['language'], \PDO::PARAM_STR);
        $queryDB->bindParam(':search_keyword', $mergedData['search_keyword'], \PDO::PARAM_STR);
        $queryDB->bindParam(':page_num', $mergedData['page_num'], \PDO::PARAM_INT);
        $queryDB->bindParam(':page_size', $mergedData['page_size'], \PDO::PARAM_INT);

        if (!$queryDB->execute())
        {
            throw new \PDOException();
        }

        return $this->prepareDataForApi(
            $queryDB->fetchAll(\PDO::FETCH_OBJ)
        );
    }
}