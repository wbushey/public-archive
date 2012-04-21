<?php

/**
 * Policy form base class.
 *
 * @package    TermsWatch
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfPropelFormGeneratedTemplate.php 16976 2009-04-04 12:47:44Z fabien $
 */
class BasePolicyForm extends BaseFormPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'pid'        => new sfWidgetFormInputHidden(),
      'cid'        => new sfWidgetFormPropelChoice(array('model' => 'Company', 'add_empty' => false)),
      'policyName' => new sfWidgetFormInput(),
      'url'        => new sfWidgetFormInput(),
      'regex'      => new sfWidgetFormInput(),
      'spoof'      => new sfWidgetFormInput(),
      'pre'        => new sfWidgetFormInput(),
    ));

    $this->setValidators(array(
      'pid'        => new sfValidatorPropelChoice(array('model' => 'Policy', 'column' => 'pid', 'required' => false)),
      'cid'        => new sfValidatorPropelChoice(array('model' => 'Company', 'column' => 'cid')),
      'policyName' => new sfValidatorString(array('max_length' => 255)),
      'url'        => new sfValidatorString(array('max_length' => 255)),
      'regex'      => new sfValidatorString(array('max_length' => 255)),
      'spoof'      => new sfValidatorInteger(),
      'pre'        => new sfValidatorInteger(),
    ));

    $this->widgetSchema->setNameFormat('policy[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'Policy';
  }


}
