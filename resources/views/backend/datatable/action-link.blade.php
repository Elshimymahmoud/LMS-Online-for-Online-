<a href="{{ $route }}"
   class="btn btn-xs btn-primary mb-1" title="Article"><i class="fas fa-blog"></i></a>
<a href="{{ $route }}" name="{{ $name }}" class="btn btn-danger"><i class="fas fa-trash" data-toggle="tooltip" data-placement="top" title="'.__('buttons.backend.access.users.delete_permanently').'"></i></a> ';
return '<a href="'.route('admin.auth.user.account.confirm.resend', $this).'" class="dropdown-item">'.__('buttons.backend.access.users.resend_email').'</a> ';
