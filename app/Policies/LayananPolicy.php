<?php

namespace App\Policies;

use App\Models\Layanan;
use App\Models\User;

class LayananPolicy
{
  public function update(User $user, Layanan $layanan): bool
  {
    if ($user->isSuperAdmin()) {
      return true;
    }

    return $user->isAdmin() && $user->group_id === $layanan->group_id;
  }

  public function delete(User $user, Layanan $layanan): bool
  {
    return $this->update($user, $layanan);
  }

  public function reorder(User $user, Layanan $layanan): bool
  {
    return $this->update($user, $layanan);
  }
}
