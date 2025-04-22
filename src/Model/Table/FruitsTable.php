<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query\SelectQuery;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Fruits Model
 *
 * @property \App\Model\Table\SaleItemsTable&\Cake\ORM\Association\HasMany $SaleItems
 *
 * @method \App\Model\Entity\Fruit newEmptyEntity()
 * @method \App\Model\Entity\Fruit newEntity(array $data, array $options = [])
 * @method array<\App\Model\Entity\Fruit> newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Fruit get(mixed $primaryKey, array|string $finder = 'all', \Psr\SimpleCache\CacheInterface|string|null $cache = null, \Closure|string|null $cacheKey = null, mixed ...$args)
 * @method \App\Model\Entity\Fruit findOrCreate($search, ?callable $callback = null, array $options = [])
 * @method \App\Model\Entity\Fruit patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method array<\App\Model\Entity\Fruit> patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\Fruit|false save(\Cake\Datasource\EntityInterface $entity, array $options = [])
 * @method \App\Model\Entity\Fruit saveOrFail(\Cake\Datasource\EntityInterface $entity, array $options = [])
 * @method iterable<\App\Model\Entity\Fruit>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Fruit>|false saveMany(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\Fruit>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Fruit> saveManyOrFail(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\Fruit>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Fruit>|false deleteMany(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\Fruit>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Fruit> deleteManyOrFail(iterable $entities, array $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class FruitsTable extends Table
{
    /**
     * Initialize method
     *
     * @param array<string, mixed> $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config): void
    {
        parent::initialize($config);

        $this->setTable('fruits');
        $this->setDisplayField('name');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->hasMany('SaleItems', [
            'foreignKey' => 'fruit_id',
        ]);
    }

    /**
     * Default validation rules.
     *
     * @param \Cake\Validation\Validator $validator Validator instance.
     * @return \Cake\Validation\Validator
     */
    public function validationDefault(Validator $validator): Validator
    {
        $validator
            ->scalar('name')
            ->maxLength('name', 100)
            ->requirePresence('name', 'create')
            ->notEmptyString('name');

        $validator
            ->scalar('classification')
            ->requirePresence('classification', 'create')
            ->notEmptyString('classification');

        $validator
            ->boolean('is_fresh')
            ->allowEmptyString('is_fresh');

        $validator
            ->integer('quantity')
            ->requirePresence('quantity', 'create')
            ->notEmptyString('quantity');

        $validator
            ->decimal('price')
            ->requirePresence('price', 'create')
            ->notEmptyString('price');

        return $validator;
    }
}
