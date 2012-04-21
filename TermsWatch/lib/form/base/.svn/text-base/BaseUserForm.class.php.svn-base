<?php

/**
 * User form base class.
 *
 * @package    TermsWatch
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfPropelFormGeneratedTemplate.php 16976 2009-04-04 12:47:44Z fabien $
 */
class BaseUserForm extends BaseFormPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'uid'      => new sfWidgetFormInputHidden(),
      'username' => new sfWidgetFormInput(),
      'password' => new sfWidgetFormInput(),
    ));

    $this->setValidators(array(
      'uid'      => new sfValidatorPropelChoice(array('model' => 'User', 'column' => 'uid', 'required' => false)),
      'username' => new sfValidatorString(array('max_length' => 64)),
      'password' => new sfValidatorString(array('max_length' => 64)),
    ));

    $this->widgetSchema->setNameFormat('user[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'User';
  }


}
