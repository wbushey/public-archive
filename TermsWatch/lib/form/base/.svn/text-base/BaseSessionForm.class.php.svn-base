<?php

/**
 * Session form base class.
 *
 * @package    TermsWatch
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfPropelFormGeneratedTemplate.php 16976 2009-04-04 12:47:44Z fabien $
 */
class BaseSessionForm extends BaseFormPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'sid'       => new sfWidgetFormInputHidden(),
      'uid'       => new sfWidgetFormInput(),
      'timestamp' => new sfWidgetFormDateTime(),
    ));

    $this->setValidators(array(
      'sid'       => new sfValidatorPropelChoice(array('model' => 'Session', 'column' => 'sid', 'required' => false)),
      'uid'       => new sfValidatorInteger(),
      'timestamp' => new sfValidatorDateTime(),
    ));

    $this->widgetSchema->setNameFormat('session[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'Session';
  }


}
