<?php
namespace AtooSync\GesCom\Model\Config\Backend;

use Magento\Eav\Model\ResourceModel\Entity\Attribute\Set\CollectionFactory;
use Magento\Framework\Option\ArrayInterface;

class AttributeSetList implements ArrayInterface
{
    protected $CollectionFactory;
	
	public function __construct(
        CollectionFactory $CollectionFactory
    )
    {
        $this->CollectionFactory = $CollectionFactory;
    }

	public function toOptionArray(){

		$arr = $this->_toArray();
		$ret = [];
		foreach ($arr as $key => $value){
			$ret[] = [
				'value' => $key,
				'label' => $value
			];
		}
		return $ret;
	}
 
	private function _toArray(){
        $arr = [];
        
        $attributeSetCollection = $this->CollectionFactory->create();
        $attributeSets = $attributeSetCollection->getItems();
        foreach ($attributeSets as $attributeSet) {
            if($attributeSet['entity_type_id']==4){
                $arr[$attributeSet['attribute_set_id']] = $attributeSet['attribute_set_name'];
            }
        }
        return $arr;
	}
}
