<?php

/**
 * StackappCategory filter form base class.
 *
 * @package    stackapp_v2.0
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseStackappCategoryFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'created_at'               => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
      'updated_at'               => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
      'stackapp_affiliates_list' => new sfWidgetFormDoctrineChoice(array('multiple' => true, 'model' => 'StackappAffiliate')),
    ));

    $this->setValidators(array(
      'created_at'               => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
      'updated_at'               => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
      'stackapp_affiliates_list' => new sfValidatorDoctrineChoice(array('multiple' => true, 'model' => 'StackappAffiliate', 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('stackapp_category_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function addStackappAffiliatesListColumnQuery(Doctrine_Query $query, $field, $values)
  {
    if (!is_array($values))
    {
      $values = array($values);
    }

    if (!count($values))
    {
      return;
    }

    $query
      ->leftJoin($query->getRootAlias().'.StackappCategoryAffiliate StackappCategoryAffiliate')
      ->andWhereIn('StackappCategoryAffiliate.affiliate_id', $values)
    ;
  }

  public function getModelName()
  {
    return 'StackappCategory';
  }

  public function getFields()
  {
    return array(
      'id'                       => 'Number',
      'created_at'               => 'Date',
      'updated_at'               => 'Date',
      'stackapp_affiliates_list' => 'ManyKey',
    );
  }
}
