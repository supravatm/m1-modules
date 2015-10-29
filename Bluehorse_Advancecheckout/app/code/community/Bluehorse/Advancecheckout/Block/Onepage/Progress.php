<?php

class Bluehorse_Advancecheckout_Block_Onepage_Progress extends Mage_Checkout_Block_Onepage_Progress  
{
  
    public function isStepComplete($currentStep)
    {
		
		$CustomSteps=array_diff($this->_getStepCodes(), array('shipping_method','shipping'));
        $stepsRevertIndex = array_flip($CustomSteps);

        $toStep = $this->getRequest()->getParam('toStep');

        if (empty($toStep) || !isset($stepsRevertIndex[$currentStep])) {
            return $this->getCheckout()->getStepData($currentStep, 'complete');
        }

        if ($stepsRevertIndex[$currentStep] > $stepsRevertIndex[$toStep]) {
            return false;
        }

        return $this->getCheckout()->getStepData($currentStep, 'complete');
    }

}
