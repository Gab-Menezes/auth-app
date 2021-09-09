<?php

namespace App\Models;

use Firebase\JWT\JWT;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Cache;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\PermissionRegistrar;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasFactory, SoftDeletes, HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'username',
        'password',
        'role',
        'token_version'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var string[]
     */
    protected $hidden = [
        'password',
        'employeeable_id',
        'employeeable_type'
    ];

    /** -------------- functions -------------- **/
    public function revokeToken(): bool
    {
        return $this->update(['token_version' => $this->token_version + 1]);
    }

    /** -------------- relations -------------- **/

    public function employeeable(): MorphTo
    {
        return $this->morphTo();
    }

    /** -------------- attributes -------------- **/

    public function getTokenAttribute(): string
    {
        $payload = [
            'username' => $this->username,
            'iat' => now()->timestamp,
            'exp' => now()->addMinutes(15)->timestamp,
            'sub' => $this->id,
//            'permissions' => [
//                "ud:consectetur",
//                "ucvd:qui",
//                "cd:facilis",
//                "d:possimus",
//                "vuc:molestias",
//                "uc:repellendus",
//                "ucv:quae",
//                "cud:dolor",
//                "vcdu:sit",
//                "cud:magni",
//                "v:aut",
//                "udv:amet",
//                "cduv:suscipit",
//                "v:quia",
//                "vdc:quaerat",
//                "dv:ab",
//                "v:exercitationem",
//                "vdcu:atque",
//                "u:et",
//                "vuc:rerum",
//                "udv:iste",
//                "cuv:beatae",
//                "c:et",
//                "cv:dolor",
//                "v:laboriosam",
//                "u:consequatur",
//                "duvc:natus",
//                "vu:suscipit",
//                "d:eius",
//                "du:quis",
//                "dc:qui",
//                "du:architecto",
//                "uc:mollitia",
//                "cvdu:dicta",
//                "ducv:vero",
//                "cd:asperiores",
//                "udcv:numquam",
//                "vd:aut",
//                "u:ullam",
//                "uc:dolorum",
//                "v:occaecati",
//                "d:distinctio",
//                "dcvu:aut",
//                "ucdv:qui",
//                "vcud:quis",
//                "vdu:deleniti",
//                "duc:porro",
//                "cuvd:officiis",
//                "duvc:expedita",
//                "vc:pariatur",
//                "vuc:eum",
//                "ud:voluptates",
//                "vdc:numquam",
//                "v:eveniet",
//                "duc:tempora",
//                "vuc:quisquam",
//                "d:praesentium",
//                "vd:molestias",
//                "c:dolore",
//                "duv:nisi",
//                "u:explicabo",
//                "ucd:rerum",
//                "vcud:adipisci",
//                "cv:est",
//                "vdc:fugiat",
//                "vc:eos",
//                "cuv:ipsum",
//                "vcu:minus",
//                "ducv:veritatis",
//                "udcv:rem",
//                "udc:omnis",
//                "vcud:magni",
//                "du:aliquid",
//                "c:perferendis",
//                "vud:mollitia",
//                "vc:optio",
//                "vuc:vel",
//                "u:inventore",
//                "u:voluptas",
//                "uv:iure",
//                "uvc:vitae",
//                "cdvu:et",
//                "vc:id",
//                "u:officia",
//                "cdv:pariatur",
//                "v:quis",
//                "dvuc:ab",
//                "vcu:voluptatibus",
//                "vd:sunt",
//                "cvd:rem",
//                "cd:voluptatem",
//                "c:quod",
//                "uvdc:nam",
//                "v:quas",
//                "d:quis",
//                "uvd:dolorum",
//                "c:consequatur",
//                "cu:molestias",
//                "d:sunt",
//                "vc:voluptatum",
//                "c:ut",
//                "cudv:consequatur",
//                "cud:fuga",
//                "cu:nobis",
//                "dc:eum",
//                "uv:soluta",
//                "cd:dolores",
//                "vcud:ut",
//                "duvc:rem",
//                "d:quasi",
//                "uv:autem",
//                "vucd:autem",
//                "c:nemo",
//                "cu:ad",
//                "cv:suscipit",
//                "c:impedit",
//                "uvdc:ut",
//                "ud:provident",
//                "c:molestiae",
//                "vdc:amet",
//                "ucv:possimus",
//                "cud:aperiam",
//                "udcv:illum",
//                "cudv:distinctio",
//                "u:quidem",
//                "vdc:iste",
//                "ud:consequatur",
//                "vucd:aspernatur",
//                "uvdc:neque",
//                "d:aliquid",
//                "uv:tempora",
//                "uvd:nobis",
//                "ucvd:laudantium",
//                "dvcu:aut",
//                "cvd:voluptatem",
//                "u:sint",
//                "dcvu:et",
//                "dvc:placeat",
//                "cdvu:omnis",
//                "ucd:soluta",
//                "u:architecto",
//                "vu:sit",
//                "dvcu:id",
//                "vcu:aspernatur",
//                "c:sed",
//                "cvu:sed",
//                "dcv:asperiores",
//                "cvd:aut",
//                "u:pariatur",
//                "uc:eos",
//                "u:animi",
//                "dvuc:dolor",
//                "u:enim",
//                "uc:sapiente",
//                "u:ut",
//                "vdcu:iste",
//                "v:laboriosam",
//                "uv:odio",
//                "cdvu:recusandae",
//                "cd:illo",
//                "udc:qui",
//                "udv:ea",
//                "ud:sed",
//                "cvud:quod",
//                "dvc:amet",
//                "uc:tenetur",
//                "d:harum",
//                "v:temporibus",
//                "vcd:sed",
//                "cdvu:repudiandae",
//                "duc:distinctio",
//                "d:corporis",
//                "du:laudantium",
//                "uv:perferendis",
//                "cud:architecto",
//                "ucvd:magnam",
//                "ucd:aut",
//                "cv:ipsa",
//                "dcvu:unde",
//                "cd:facere",
//                "cv:similique",
//                "vduc:consectetur",
//                "uc:vitae",
//                "cud:exercitationem",
//                "cu:eveniet",
//                "vcd:quod",
//                "uvd:dolores",
//                "cv:et",
//                "uc:minima",
//                "du:voluptatem",
//                "cuv:iste",
//                "u:quo",
//                "ud:sed",
//                "u:quod",
//                "cu:iusto",
//                "dc:sit",
//                "cdu:ab",
//                "v:molestias",
//                "du:eius",
//                "vcd:ipsum",
//            ]
        ];

        return JWT::encode($payload, Cache::get('token_key'), 'RS256');
    }

    public function getRefreshTokenAttribute(): string
    {
        $payload = [
            'username' => $this->username,
            'iat' => now()->timestamp,
            'exp' => now()->addDays(7)->timestamp,
            'sub' => $this->id,
            'token_version' => $this->token_version
        ];

        return JWT::encode($payload, Cache::get('refresh_token_key'), 'RS256');
    }

    /**
     * @return array<string, string>
     */
    public function getTokensAttribute(): array
    {
        return [
            'token' => $this->token,
            'refresh_token' => $this->refresh_token
        ];
    }


    /** -------------- permissions -------------- **/


    public function hasCachedPermissionTo(Permission $permission, string|null $guardName = null): bool
    {
//        if (is_int($permission)) return $this->getCachedPermissions()->contains('id', $permission);
//        if (is_string($permission)) return $this->getCachedPermissions()->contains('name', $permission);
//        if (is_string($permission)) return $this->getCachedPermissions()->contains('n', $permission);
//        return $this->getCachedPermissions()->contains('i', $permission->id);
        if (!Cache::has(PermissionRegistrar::$cacheKey)) app(PermissionRegistrar::class)->getPermissions();
        return $this->getCachedPermissions()->contains($permission->id);
    }

    public function getAllPermissionsID(): Collection
    {
        return $this->getAllPermissions()->pluck('id');
    }

    private function dehydratePermissions(): Collection
    {
        return $this->getAllPermissions()->map(function ($perm) {
            return ['i' => $perm->id, 'n' => $perm->name, 'g' => $perm->guard_name];
//            return ['i' => $perm->id, 'n' => $perm->name];
        });
    }

    public function clearPermissionsName(): bool
    {
        return Cache::forget("user_permissions.$this->id");
    }

    public function setCachedPermissionsName(): bool
    {
//        return Cache::put("user_permissions.$this->id", $this->dehydratePermissions(), 15*60);
        return Cache::put("user_permissions.$this->id", $this->getAllPermissionsID(), 15*60);
    }

    public function getCachedPermissions(): Collection
    {
        $me = $this;
        /** @var Collection $cachedPermissions */
        $cachedPermissions = Cache::remember("user_permissions.$this->id", 15*60, function () use ($me) {
//            return $me->dehydratePermissions();
            return $me->getAllPermissionsID();
        });
        return $cachedPermissions;

        return Permission::hydrate(
            $cachedPermissions->map(function ($perm) {
                return ['id' => $perm['i'], 'name' => $perm['n'], 'guard_name' => $perm['g']];
            })->all()
        );
    }



//    protected function getPermissionCacheKey(string $relation): string {
//        return "user_$relation.$this->id";
//    }
//
//    private function getCachedPermissions(string $relation): Collection {
//        info('getCachedPermissions');
//        if ($this->relationLoaded($relation)) {
//            return $this->getRelationValue($relation);
//        }
//
//        $class = $relation === 'roles' ? app(PermissionRegistrar::class)->getRoleClass() : app(PermissionRegistrar::class)->getPermissionClass();
//        $array = Cache::remember($this->getPermissionCacheKey($relation), config('session.lifetime', 120) * 60, function () use($relation) {
//            return $this->getRelationValue($relation)
//                ->map(function($data){
//                    return ['i' => $data->id, 'n' => $data->name, 'g' => $data->guard_name];
//                })
//                ->all();
//        });
//
//        $collection = $class::hydrate(
//            collect($array)
//                ->map(function ($item) {
//                    return ['id' => $item['i'], 'name' => $item['n'], 'guard_name' => $item['g']];
//                })
//                ->all()
//        );
//
//        $this->setRelation($relation, $collection);
//        return $collection;
//    }
//
//    public function getRolesAttribute(): Collection {
//        return $this->getCachedPermissions('roles');
//    }
//
//    public function getPermissionsAttribute(): Collection {
//        return $this->getCachedPermissions('permissions');
//    }
//
//    public function forgetAssignedPermissions(): bool {
//        return Cache::forget($this->getPermissionCacheKey('roles'))
//            && Cache::forget($this->getPermissionCacheKey('permissions'));
//    }
}
