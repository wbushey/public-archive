<?php

/**
 * Version form base class.
 *
 * @package    TermsWatch
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfPropelFormGeneratedTemplate.php 16976 2009-04-04 12:47:44Z fabien $
 */
class BaseVersionForm extends BaseFormPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'vid'     => new sfWidgetFormInputHidden(),
      'pid'     => new sfWidgetFormPropelChoice(array('model' => 'Policy', 'add_empty' => false)),
      'content' => new sfWidgetFormTextarea(),
    ));

    $this->setValidators(array(
      'vid'     => new sfValidatorPropelChoice(array('model' => 'Version', 'column' => 'vid', 'required' => false)),
      'pid'     => new sfValidatorPropelChoice(array('model' => 'Policy', 'column' => 'pid')),
      'content' => new sfValidatorString(),
    ));

    $this->widgetSchema->setNameFormat('version[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'Version';
  }


}
