<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Organization extends Model
{
    use HasFactory;
    protected $fillable = ['name'];

    public function users()
    {
        return $this->hasMany(User::class);
    }

    public function clients()
    {
        return $this->hasMany(Client::class);
    }

    public function cases()
    {
        return $this->hasMany(CaseModel::class); // rename Case to CaseModel to avoid PHP conflict
    }
//     public function createOrganizationForUser(User $user)
// {
//     if (!$user->organization) {
//         $organization = Organization::create([
//             'name' => $user->name . "'s Practice",
//         ]);
//         $user->organization_id = $organization->id;
//         $user->save();
//     }
// }
}
