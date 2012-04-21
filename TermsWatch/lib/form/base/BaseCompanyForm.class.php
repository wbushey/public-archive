<?php

/**
 * Company form base class.
 *
 * @package    TermsWatch
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfPropelFormGeneratedTemplate.php 16976 2009-04-04 12:47:44Z fabien $
 */
class BaseCompanyForm extends BaseFormPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'cid'         => new sfWidgetFormInputHidden(),
      'companyName' => new sfWidgetFormInput(),
      'image_small' => new sfWidgetFormInput(),
      'image_large' => new sfWidgetFormInput(),
    ));

    $this->setValidators(array(
      'cid'         => new sfValidatorPropelChoice(array('model' => 'Company', 'column' => 'cid', 'required' => false)),
      'companyName' => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'image_small' => new sfValidatorString(array('max_length' => 128, 'required' => false)),
      'image_large' => new sfValidatorString(array('max_length' => 128, 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('company[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'Company';
  }


}
