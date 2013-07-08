<?php

/**
 * StackappAffiliate form base class.
 *
 * @method StackappAffiliate getObject() Returns the current form's model object
 *
 * @package    stackapp_v2.0
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseStackappAffiliateForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'                       => new sfWidgetFormInputHidden(),
      'url'                      => new sfWidgetFormInputText(),
      'email'                    => new sfWidgetFormInputText(),
      'token'                    => new sfWidgetFormInputText(),
      'is_active'                => new sfWidgetFormInputCheckbox(),
      'created_at'               => new sfWidgetFormDateTime(),
      'updated_at'               => new sfWidgetFormDateTime(),
      'stackapp_categories_list' => new sfWidgetFormDoctrineChoice(array('multiple' => true, 'model' => 'StackappCategory')),
    ));

    $this->setValidators(array(
      'id'                       => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'url'                      => new sfValidatorString(array('max_length' => 255)),
      'email'                    => new sfValidatorString(array('max_length' => 255)),
      'token'                    => new sfValidatorString(array('max_length' => 255)),
      'is_active'                => new sfValidatorBoolean(array('required' => false)),
      'created_at'               => new sfValidatorDateTime(),
      'updated_at'               => new sfValidatorDateTime(),
      'stackapp_categories_list' => new sfValidatorDoctrineChoice(array('multiple' => true, 'model' => 'StackappCategory', 'required' => false)),
    ));

    $this->validatorSchema->setPostValidator(
      new sfValidatorDoctrineUnique(array('model' => 'StackappAffiliate', 'column' => array('email')))
    );

    $this->widgetSchema->setNameFormat('stackapp_affiliate[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'StackappAffiliate';
  }

  public function updateDefaultsFromObject()
  {
    parent::updateDefaultsFromObject();

    if (isset($this->widgetSchema['stackapp_categories_list']))
    {
      $this->setDefault('stackapp_categories_list', $this->object->StackappCategories->getPrimaryKeys());
    }

  }

  protected function doSave($con = null)
  {
    $this->saveStackappCategoriesList($con);

    parent::doSave($con);
  }

  public function saveStackappCategoriesList($con = null)
  {
    if (!$this->isValid())
    {
      throw $this->getErrorSchema();
    }

    if (!isset($this->widgetSchema['stackapp_categories_list']))
    {
      // somebody has unset this widget
      return;
    }

    if (null === $con)
    {
      $con = $this->getConnection();
    }

    $existing = $this->object->StackappCategories->getPrimaryKeys();
    $values = $this->getValue('stackapp_categories_list');
    if (!is_array($values))
    {
      $values = array();
    }

    $unlink = array_diff($existing, $values);
    if (count($unlink))
    {
      $this->object->unlink('StackappCategories', array_values($unlink));
    }

    $link = array_diff($values, $existing);
    if (count($link))
    {
      $this->object->link('StackappCategories', array_values($link));
    }
  }

}
