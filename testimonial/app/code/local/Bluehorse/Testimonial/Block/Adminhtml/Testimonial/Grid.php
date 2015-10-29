<?php
class Bluehorse_Testimonial_Block_Adminhtml_Testimonial_Grid extends Mage_Adminhtml_Block_Widget_Grid
{

    /**
     * Constructor
     */
    public function __construct()
    {
        parent::__construct();
        $this->setId('testimonialGrid');
		$this->setDefaultSort('testimonial_id');
        $this->setDefaultDir('ASC');
        $this->setSaveParametersInSession(true);
		$this->setUseAjax(true);
    }

    /**
     * Prepare grid collection object
     *
     * @return Testimonial_Block_Adminhtml_Testimonial_Grid
     */
    protected function _prepareCollection()
    {
        $this->setCollection(Mage::getModel('testimonial/testimonial')->getCollection());
        return parent::_prepareCollection();
    }

    /**
     * Preparing colums for grid
     *
     * @return Testimonial_Block_Adminhtml_Testimonial_Grid
     */
    protected function _prepareColumns()
    {
      $this->addColumn('testimonial_id', array(
          'header'    => Mage::helper('testimonial')->__('ID'),
          'align'     =>'right',
          'width'     => '50px',
          'index'     => 'testimonial_id',
      ));
      $this->addColumn('testimonial_name', array(
            'header'    => Mage::helper('testimonial')->__('Name'),
            'align'     =>'left',
			'width'     => '100px',
            'index'     => 'testimonial_name',
        ));
	  $this->addColumn('order_id', array(
            'header'    => Mage::helper('testimonial')->__('Order ID'),
            'align'     =>'left',
			'width'     => '100px',
            'index'     => 'order_id',
        ));

	 $this->addColumn('testimonial_text', array(
            'header'    => Mage::helper('testimonial')->__('Comment'),
            'align'     =>'left',
			'width'     => '300px',
            'index'     => 'testimonial_text',
        ));
/*	$this->addColumn('testimonial_image', array(
            'header'    => Mage::helper('testimonial')->__('Photo'),
            'align'     =>'left',
			'width'     => '50px',
            'index'     => 'testimonial_image',
			'renderer'  => 'testimonial/adminhtml_testimonial_renderer_image'
        ));
*/
      
	  $this->addColumn('country', array(
            'header'    => Mage::helper('testimonial')->__('Country'),
            'align'     =>'left',
			'width'     => '50px',
            'index'     => 'country',
        ));
      $this->addColumn('email', array(
            'header'    => Mage::helper('testimonial')->__('Email ID'),
            'align'     =>'left',
			'width'     => '50px',
            'index'     => 'email',
        ));
      $this->addColumn('address', array(
            'header'    => Mage::helper('testimonial')->__('Street Address'),
            'align'     =>'left',
			'width'     => '50px',
            'index'     => 'address',
        ));
	  
	  $this->addColumn('created_time', array(
            'header'    => Mage::helper('testimonial')->__('Creation Time'),
            'align'     => 'left',
            'width'     => '70px',
            'type'      => 'date',
            'default'   => '--',
            'index'     => 'created_time',
        ));
	 $this->addColumn('update_time', array(
            'header'    => Mage::helper('testimonial')->__('Update Time'),
            'align'     => 'left',
            'width'     => '70px',
            'type'      => 'date',
            'default'   => '--',
            'index'     => 'update_time',
        )); 
      $this->addColumn('status', array(
          'header'    => Mage::helper('testimonial')->__('Status'),
          'align'     => 'left',
          'width'     => '70px',
          'index'     => 'status',
          'type'      => 'options',
          'options'   => array(
              1 => 'Enabled',
              2 => 'Disabled',
          ),
      ));
      $this->addColumn('action',
            array(
                'header'    =>  Mage::helper('testimonial')->__('Action'),
                'width'     => '70',
				'align'     => 'center',
                'type'      => 'action',
                'getter'    => 'getId',
                'actions'   => array(
                    array(
                        'caption'   => Mage::helper('testimonial')->__('Edit'),
                        'url'       => array('base'=> '*/*/edit'),
                        'field'     => 'id'
                    )
                ),
                'filter'    => false,
                'sortable'  => false,
                'index'     => 'stores',
                'is_system' => true,
        ));
		
		$this->addExportType('*/*/exportCsv', Mage::helper('testimonial')->__('CSV'));
		$this->addExportType('*/*/exportXml', Mage::helper('testimonial')->__('XML'));
	  
      return parent::_prepareColumns();
  }
    protected function _prepareMassaction()
    {
        $this->setMassactionIdField('testimonial_id');
        $this->getMassactionBlock()->setFormFieldName('testimonial');

        $this->getMassactionBlock()->addItem('delete', array(
             'label'    => Mage::helper('testimonial')->__('Delete'),
             'url'      => $this->getUrl('*/*/massDelete'),
             'confirm'  => Mage::helper('testimonial')->__('Are you sure?')
        ));

        $statuses = Mage::getSingleton('testimonial/status')->getOptionArray();

        array_unshift($statuses, array('label'=>'', 'value'=>''));
        $this->getMassactionBlock()->addItem('status', array(
             'label'=> Mage::helper('testimonial')->__('Change status'),
             'url'  => $this->getUrl('*/*/massStatus', array('_current'=>true)),
             'additional' => array(
                    'visibility' => array(
                         'name' => 'status',
                         'type' => 'select',
                         'class' => 'required-entry',
                         'label' => Mage::helper('testimonial')->__('Status'),
                         'values' => $statuses
                     )
             )
        ));
       return $this;
    }

    public function getRowUrl($row)
    {
        return $this->getUrl('*/*/edit', array('id' => $row->getId()));
    }

  public function getGridUrl()
    {
      return $this->getUrl('*/*/grid', array('_current'=>true));
    }

}
