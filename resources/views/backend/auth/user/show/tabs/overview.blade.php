<div class="col">
    <div class="table-responsive">
        <table class="table table-hover">
            <tr>
                <th>@lang('labels.backend.access.users.tabs.content.overview.avatar')</th>
                <td><img src="{{ $user->picture }}" class="user-profile-image" /></td>
            </tr>

            <tr>
                <th>@lang('labels.backend.access.users.tabs.content.overview.name_ar')</th>
                <td>
                    {{ $user->name_ar }} {{$user->sec_name_ar}} 
                    {{$user->third_name_ar}} {{$user->fourth_name_ar}}
                </td>
            </tr>
            <tr>
                <th>@lang('labels.backend.access.users.tabs.content.overview.name')</th>
                <td>
                    {{ $user->first_name }} {{$user->last_name}} 
                    {{$user->third_name}} {{$user->fourth_name}}
                </td>
            </tr>
            <tr>
                <th>@lang('labels.backend.access.users.tabs.content.overview.email')</th>
                <td>{{ $user->email }}</td>
            </tr>
            <tr>
                <th>@lang('validation.attributes.frontend.national_id_number')</th>
                <td>{{ $user->national_id_number }}</td>
            </tr>
            <tr>
                <th>@lang('validation.attributes.frontend.educational_qualification')</th>
                <td>{{ $user->educational_qualification }}</td>
            </tr>
            <tr>
                <th>@lang('validation.attributes.frontend.nationality')</th>
                <td>{{ $user->nationality }}</td>
            </tr>
            <tr>
                <th>@lang('validation.attributes.frontend.phone')</th>
                <td>{{ $user->phone }}</td>
            </tr>
            <tr>
                <th>@lang('labels.backend.access.users.tabs.content.overview.status')</th>
                <td>{!! $user->status_label !!}</td>
            </tr>

            <tr>
                <th>@lang('labels.backend.access.users.tabs.content.overview.confirmed')</th>
                <td>{!! $user->confirmed_label !!}</td>
            </tr>

            <tr>
                <th>@lang('labels.backend.access.users.tabs.content.overview.timezone')</th>
                <td>{{ $user->timezone }}</td>
            </tr>

            <tr>
                <th>@lang('labels.backend.access.users.tabs.content.overview.last_login_at')</th>
                <td>
                    @if($user->last_login_at)
                        {{ timezone()->convertToLocal($user->last_login_at) }}
                    @else
                        N/A
                    @endif
                </td>
            </tr>

            <tr>
                <th>@lang('labels.backend.access.users.tabs.content.overview.last_login_ip')</th>
                <td>{{ $user->last_login_ip ?? 'N/A' }}</td>
            </tr>
        </table>
    </div>
</div><!--table-responsive-->
