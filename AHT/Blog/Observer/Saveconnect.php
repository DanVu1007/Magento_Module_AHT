<?php
namespace AHT\Blog\Observer;

class Saveconnect implements \Magento\Framework\Event\ObserverInterface
{
    const QUOTE_TABLE = 'blog_category_connect';
    /**
     * @param \Magento\Framework\App\Action\Context
     */
    private $actionContext;

    /**
     * @param \Magento\Framework\App\ResourceConnection
     */
    private $resourceConnection;

    public function __construct(
        \Magento\Framework\App\Action\Context $actionContext,
        \Magento\Framework\App\ResourceConnection $resourceConnection
    )
    {
        $this->actionContext = $actionContext;
        $this->resourceConnection = $resourceConnection;
    }

    public function execute(\Magento\Framework\Event\Observer $observer)
    {
        //get Obj-data after save
        $myEventData = $observer->getData('data_object')->getData();
        $blogID = $myEventData['blog_id'];
        $cateIDs = explode(',',$myEventData['category_ids']);
    
        //Array to insert table blog_category_connect
        //data
        $data = [];
        foreach ($cateIDs as $key => $value) {
            $item = ['blog_id'=>$blogID, 'blog_category_id'=>$value];
            array_push($data,$item);
        }
        //condition
        $where = ['blog_id = ?' => (int)$blogID];

        //Connection
        $connection  = $this->resourceConnection->getConnection();
        $tableName = $connection->getTableName(self::QUOTE_TABLE);
        $connection->delete($tableName,$where);
        $connection->insertMultiple($tableName,$data);
    }
}
