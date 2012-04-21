<?php

/**
 * Scrape form base class.
 *
 * @package    TermsWatch
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfPropelFormGeneratedTemplate.php 16976 2009-04-04 12:47:44Z fabien $
 */
class BaseScrapeForm extends BaseFormPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'sid'       => new sfWidgetFormInputHidden(),
      'pid'       => new sfWidgetFormPropelChoice(array('model' => 'Policy', 'add_empty' => false)),
      'timestamp' => new sfWidgetFormDateTime(),
      'outcome'   => new sfWidgetFormInput(),
      'vid'       => new sfWidgetFormPropelChoice(array('model' => 'Version', 'add_empty' => false)),
    ));

    $this->setValidators(array(
      'sid'       => new sfValidatorPropelChoice(array('model' => 'Scrape', 'column' => 'sid', 'required' => false)),
      'pid'       => new sfValidatorPropelChoice(array('model' => 'Policy', 'column' => 'pid')),
      'timestamp' => new sfValidatorDateTime(),
      'outcome'   => new sfValidatorInteger(),
      'vid'       => new sfValidatorPropelChoice(array('model' => 'Version', 'column' => 'vid')),
    ));

    $this->widgetSchema->setNameFormat('scrape[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'Scrape';
  }


}
