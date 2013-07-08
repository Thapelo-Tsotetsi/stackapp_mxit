<?php

/**
 * StackappCategory form base class.
 *
 * @method StackappCategory getObject() Returns the current form's model object
 *
 * @package    stackapp_v2.0
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseStackappCategoryForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'                       => new sfWidgetFormInputHidden(),
      'created_at'               => new sfWidgetFormDateTime(),
      'updated_at'               => new sfWidgetFormDateTime(),
      'stackapp_affiliates_list' => new sfWidgetFormDoctrineChoice(array('multiple' => true, 'model' => 'StackappAffiliate')),
    ));

    $this->setValidators(array(
      'id'                       => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'created_at'               => new sfValidatorDateTime(),
      'updated_at'               => new sfValidatorDateTime(),
      'stackapp_affiliates_list' => new sfValidatorDoctrineChoice(array('multiple' => true, 'model' => 'StackappAffiliate', 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('stackapp_category[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'StackappCategory';
  }

  public function updateDefaultsFromObject()
  {
    parent::updateDefaultsFromObject();

    if (isset($this->widgetSchema['stackapp_affiliates_list']))
    {
      $this->setDefault('stackapp_affiliates_list', $this->object->StackappAffiliates->getPrimaryKeys());
    }

  }

  protected function doSave($con = null)
  {
    $this->saveStackappAffiliatesList($con);

    parent::doSave($con);
  }

  public function saveStackappAffiliatesList($con = null)
  {
    if (!$this->isValid())
    {
      throw $this->getErrorSchema();
    }

    if (!isset($this->widgetSchema['stackapp_affiliates_list']))
    {
      // somebody has unset this widget
      return;
    }

    if (null === $con)
    {
      $con = $this->getConnection();
    }

    $existing = $this->object->StackappAffiliates->getPrimaryKeys();
    $values = $this->getValue('stackapp_affiliates_list');
    if (!is_array($values))
    {
      $values = array();
    }

    $unlink = array_diff($existing, $values);
    if (count($unlink))
    {
      $this->object->unlink('StackappAffiliates', array_values($unlink));
    }

    $link = array_diff($values, $existing);
    if (count($link))
    {
      $this->object->link('StackappAffiliates', array_values($link));
    }
  }

}
