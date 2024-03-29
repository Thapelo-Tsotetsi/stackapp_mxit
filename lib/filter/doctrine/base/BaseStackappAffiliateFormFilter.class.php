<?php

/**
 * StackappAffiliate filter form base class.
 *
 * @package    stackapp_v2.0
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseStackappAffiliateFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'url'                      => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'email'                    => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'token'                    => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'is_active'                => new sfWidgetFormChoice(array('choices' => array('' => 'yes or no', 1 => 'yes', 0 => 'no'))),
      'created_at'               => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
      'updated_at'               => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
      'stackapp_categories_list' => new sfWidgetFormDoctrineChoice(array('multiple' => true, 'model' => 'StackappCategory')),
    ));

    $this->setValidators(array(
      'url'                      => new sfValidatorPass(array('required' => false)),
      'email'                    => new sfValidatorPass(array('required' => false)),
      'token'                    => new sfValidatorPass(array('required' => false)),
      'is_active'                => new sfValidatorChoice(array('required' => false, 'choices' => array('', 1, 0))),
      'created_at'               => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
      'updated_at'               => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
      'stackapp_categories_list' => new sfValidatorDoctrineChoice(array('multiple' => true, 'model' => 'StackappCategory', 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('stackapp_affiliate_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function addStackappCategoriesListColumnQuery(Doctrine_Query $query, $field, $values)
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
      ->andWhereIn('StackappCategoryAffiliate.category_id', $values)
    ;
  }

  public function getModelName()
  {
    return 'StackappAffiliate';
  }

  public function getFields()
  {
    return array(
      'id'                       => 'Number',
      'url'                      => 'Text',
      'email'                    => 'Text',
      'token'                    => 'Text',
      'is_active'                => 'Boolean',
      'created_at'               => 'Date',
      'updated_at'               => 'Date',
      'stackapp_categories_list' => 'ManyKey',
    );
  }
}
