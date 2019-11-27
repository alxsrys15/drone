<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Genders Model
 *
 * @property \App\Model\Table\ProductsTable&\Cake\ORM\Association\HasMany $Products
 *
 * @method \App\Model\Entity\Gender get($primaryKey, $options = [])
 * @method \App\Model\Entity\Gender newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Gender[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Gender|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Gender saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Gender patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Gender[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Gender findOrCreate($search, callable $callback = null, $options = [])
 */
class GendersTable extends Table
{
    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config)
    {
        parent::initialize($config);

        $this->setTable('genders');
        $this->setDisplayField('name');
        $this->setPrimaryKey('id');

        $this->hasMany('Products', [
            'foreignKey' => 'gender_id'
        ]);
    }

    /**
     * Default validation rules.
     *
     * @param \Cake\Validation\Validator $validator Validator instance.
     * @return \Cake\Validation\Validator
     */
    public function validationDefault(Validator $validator)
    {
        $validator
            ->integer('id')
            ->allowEmptyString('id', null, 'create');

        $validator
            ->scalar('name')
            ->maxLength('name', 50)
            ->requirePresence('name', 'create')
            ->notEmptyString('name');

        return $validator;
    }
}
