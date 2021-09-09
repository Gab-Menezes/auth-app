<?php

// @formatter:off
/**
 * A helper file for your Eloquent Models
 * Copy the phpDocs from this file to the correct Model,
 * And remove them from this file, to prevent double declarations.
 *
 * @author Barry vd. Heuvel <barryvdh@gmail.com>
 */


namespace App\Models{
/**
 * App\Models\Client
 *
 * @property int $id
 * @property string $name
 * @property int|null $client_id
 * @property bool $is_headquarter
 * @property string|null $deleted_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\ClientEmployee[] $clientEmployees
 * @property-read int|null $client_employees_count
 * @method static \Database\Factories\ClientFactory factory(...$parameters)
 * @method static \Illuminate\Database\Eloquent\Builder|Client newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Client newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Client query()
 */
	class Client extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\ClientEmployee
 *
 * @property int $id
 * @property int $client_id
 * @property string $name
 * @property string $sex
 * @property string $department
 * @property string $birth_date
 * @property string|null $deleted_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Client $client
 * @property-read \App\Models\User|null $user
 * @method static \Database\Factories\ClientEmployeeFactory factory(...$parameters)
 * @method static \Illuminate\Database\Eloquent\Builder|ClientEmployee newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ClientEmployee newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ClientEmployee query()
 */
	class ClientEmployee extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\InternalEmployee
 *
 * @property int $id
 * @property string $name
 * @property string $sex
 * @property string $department
 * @property string $birth_date
 * @property string|null $deleted_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\User|null $user
 * @method static \Database\Factories\InternalEmployeeFactory factory(...$parameters)
 * @method static \Illuminate\Database\Eloquent\Builder|InternalEmployee newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|InternalEmployee newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|InternalEmployee query()
 */
	class InternalEmployee extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\User
 *
 * @property int $id
 * @property string $username
 * @property string $password
 * @property int $token_version
 * @property string $employeeable_type
 * @property int $employeeable_id
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Model|\Eloquent $employeeable
 * @property-read string $refresh_token
 * @property-read string $token
 * @property-read array $tokens
 * @property-read \Illuminate\Database\Eloquent\Collection|\Spatie\Permission\Models\Permission[] $permissions
 * @property-read int|null $permissions_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\Spatie\Permission\Models\Role[] $roles
 * @property-read int|null $roles_count
 * @method static \Database\Factories\UserFactory factory(...$parameters)
 * @method static \Illuminate\Database\Eloquent\Builder|User newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|User newQuery()
 * @method static \Illuminate\Database\Query\Builder|User onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|User permission($permissions)
 * @method static \Illuminate\Database\Eloquent\Builder|User query()
 * @method static \Illuminate\Database\Eloquent\Builder|User role($roles, $guard = null)
 * @method static \Illuminate\Database\Query\Builder|User withTrashed()
 * @method static \Illuminate\Database\Query\Builder|User withoutTrashed()
 */
	class User extends \Eloquent {}
}

