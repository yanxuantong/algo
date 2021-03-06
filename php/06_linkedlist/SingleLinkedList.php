<?php
/**
 * User: lide01
 * Date: 2018/10/8 11:55
 * Desc:
 */

namespace Algo_06;


/**
 * 单链表
 *
 * Class SingleLinkedList
 *
 * @package Algo_06
 */
class SingleLinkedList
{
    /**
     * 单链表头结点（哨兵节点）
     *
     * @var SingleLinkedListNode
     */
    public $head;

    /**
     * 单链表长度
     *
     * @var
     */
    private $length;

    /**
     * 初始化单链表
     *
     * SingleLinkedList constructor.
     */
    public function __construct()
    {
        $this->head = new SingleLinkedListNode();
        $this->length = 0;
    }

    /**
     * 获取链表长度
     *
     * @return int
     */
    public function getLength()
    {
        return $this->length;
    }

    /**
     * 插入数据 采用头插法 插入新数据
     *
     * @param $data
     *
     * @return SingleLinkedListNode|bool
     */
    public function insert($data)
    {
        return $this->insertDataAfter($this->head, $data);
    }

    /**
     * 删除节点
     *
     * @param SingleLinkedListNode $node
     *
     * @return bool
     */
    public function delete(SingleLinkedListNode $node)
    {
        if (null == $node) {
            return false;
        }

        // 获取待删除节点的前置节点
        $preNode = $this->getPreNode($node);

        // 修改指针指向
        $preNode->next = $node->next;
        unset($node);

        $this->length--;
        return true;
    }

    /**
     * 通过索引获取节点
     *
     * @param int $index
     *
     * @return SingleLinkedListNode|null
     */
    public function getNodeByIndex($index)
    {
        if ($index >= $this->length) {
            return null;
        }

        $cur = $this->head->next;
        for ($i = 0; $i < $index; ++$i) {
            $cur = $cur->next;
        }

        return $cur;
    }

    /**
     * 获取某个节点的前置节点
     *
     * @param SingleLinkedListNode $node
     *
     * @return SingleLinkedListNode|bool
     */
    public function getPreNode(SingleLinkedListNode $node)
    {
        if (null == $node) {
            return false;
        }

        $curNode = $this->head;
        $preNode = $this->head;
        // 遍历找到前置节点 要用全等判断是否是同一个对象
        // http://php.net/manual/zh/language.oop5.object-comparison.php
        while ($curNode !== $node) {
            $preNode = $curNode;
            $curNode = $curNode->next;
        }

        return $preNode;
    }

    /**
     * 输出单链表 当data的数据为可输出类型
     *
     * @return bool
     */
    public function printList()
    {
        if (null == $this->head->next) {
            return false;
        }

        $curNode = $this->head;
        while ($curNode->next != null) {
            echo $curNode->next->data . ' ';

            $curNode = $curNode->next;
        }
        echo PHP_EOL;

        return true;
    }

    /**
     * 在某个节点后插入新的节点
     *
     * @param SingleLinkedListNode $originNode
     * @param                      $data
     *
     * @return SingleLinkedListNode|bool
     */
    public function insertDataAfter(SingleLinkedListNode $originNode, $data)
    {
        // 如果originNode为空，插入失败
        if (null == $originNode) {
            return false;
        }

        // 新建单链表节点
        $newNode = new SingleLinkedListNode();
        // 新节点的数据
        $newNode->data = $data;

        // 新节点的下一个节点为源节点的下一个节点
        $newNode->next = $originNode->next;
        // 在originNode后插入newNode
        $originNode->next = $newNode;

        // 链表长度++
        $this->length++;

        return $newNode;
    }

    /**
     * 在某个节点前插入新的节点（很少使用）
     *
     * @param SingleLinkedListNode $originNode
     * @param                      $data
     *
     * @return SingleLinkedListNode|bool
     */
    public function insertDataBefore(SingleLinkedListNode $originNode, $data)
    {
        // 如果originNode为空，插入失败
        if (null == $originNode) {
            return false;
        }

        // 先找到originNode的前置节点，然后通过insertDataAfter插入
        $preNode = $this->getPreNode($originNode);

        return $this->insertDataAfter($preNode, $data);
    }
}