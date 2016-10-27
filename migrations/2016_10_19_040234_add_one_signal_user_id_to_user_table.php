<?php
use Illuminate\Database\ConnectionInterface;
use Illuminate\Database\Schema\Builder;
return [ 
		'up' => function (Builder $schema, ConnectionInterface $db) {
			$schema->table ( 'users', function ($table) {
				$table->string ( 'one_signal_user_id' );
			} );
		},
		'down' => function (Builder $schema) {
			$schema->table ( 'users', function ($table) {
                   $table->dropColumn('one_signal_user_id');
               });
    }
];