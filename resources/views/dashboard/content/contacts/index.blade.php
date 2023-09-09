@extends('dashboard/layouts/layoutMaster')

@section('title', 'Contacts')

@section('breadcrumb_left')
    <span class="text-muted fw-light ">Contacts/</span> Contacts List
@endsection


@section('content')
    <div class="card">
        <div class="table-responsive text-nowrap">
            <table class="table table-hover ">
                <thead class="table-light">
                <tr>
                    <th>#ID</th>
                    <th>Subject</th>
                    <th>From</th>
                    <th>Status</th>
                    <th>Created At</th>
                    <th>Actions</th>
                </tr>
                </thead>
                <tbody class="table-border-bottom-0">
                @foreach($contacts as $contact)
                    <tr>
                        <td>{{ $contact->id }}</td>
                        <td>{{ $contact->subject }}</td>
                        <td>{{ $contact->name }}
                            @if($contact->user->name!==$contact->name)
                                ({{$contact->user->name}})
                            @endif
                        </td>
                        <td id="contactStatus{{$contact->id}}">
                            @if ($contact->status == 'new')
                                <span class="badge bg-label-success me-1">{{ $contact->status }}</span>
                            @else
                                <span class="badge bg-label-secondary me-1">{{ $contact->status }}</span>
                            @endif
                        </td>
                        <td>
                            {{ $contact->created_at->diffForHumans() }}
                        </td>
                        @admin
                        <td>
                            <a href="#" class="viewedContact" data-id="{{$contact->id}}" data-bs-toggle="modal" data-bs-target="#viewContact{{$contact->id}}">
                                <i class="ti ti-eye me-1"></i>
                            </a>
                            <div class="modal fade" id="viewContact{{$contact->id}}" tabindex="-1" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="">{{ $contact->subject }}</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <table class="table">
                                                <tbody>
{{--                                                    <tr>--}}
{{--                                                        <td>Subject:</td>--}}
{{--                                                        <td>{{ $contact->subject }}</td>--}}
{{--                                                    </tr>--}}
                                                    <tr>
                                                        <td>From :</td>
                                                        <td>{{ $contact->name }}
                                                            @if($contact->user->name!==$contact->name)
                                                                ({{$contact->user->name}})
                                                            @endif
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>Email :</td>
                                                        <td>
                                                            {{ $contact->email }}
                                                            @if($contact->user->email && $contact->user->email!==$contact->email)
                                                                <br />
                                                                {{ $contact->user->email }} (Email Account)
                                                            @endif
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>Massage :</td>
                                                        <td  style="white-space: normal; max-width: 300px;">{{ $contact->message }}</td>
                                                    </tr>
                                                    <tr>
                                                        <td>Date :</td>
                                                        <td>{{ $contact->created_at->diffForHumans() }}</td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <a class="" style="color: #dc0000;" onclick="deleteConfirm({{$contact->id}})" href="#">
                                <i class="ti ti-trash me-1"></i>
                            </a>
                            <form action="{{ route('dashboard.contacts.destroy', $contact->id) }}" method="post" id={{$contact->id}}>
                                @csrf
                                @method('delete')
                            </form>
                        </td>
                        @endadmin
                    </tr>
                @endforeach
                </tbody>
            </table>
            <div class="card-footer pb-2 ms-5">
                {{ $contacts->withQueryString()->links() }}
            </div>
        </div>
    </div>
@endsection