@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.ticket.title') }}
    </div>

    <div class="card-body">
        @if(session('status'))
            <div class="alert alert-success" role="alert">
                {{ session('status') }}
            </div>
        @endif
        <div class="mb-2">
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.ticket.fields.id') }}
                        </th>
                        <td>
                            {{ $ticket->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.ticket.fields.created_at') }}
                        </th>
                        <td>
                            {{ $ticket->created_at }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.ticket.fields.title') }}
                        </th>
                        <td>
                            {{ $ticket->title }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.ticket.fields.content') }}
                        </th>
                        <td>
                            {!! $ticket->content !!}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.ticket.fields.attachments') }}
                        </th>
                        <td>
                            @foreach($ticket->attachments as $attachment)
                                <a href="{{ $attachment->getUrl() }}" target="_blank">{{ $attachment->file_name }}</a>
                            @endforeach
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.ticket.fields.status') }}
                        </th>
                        <td>
                            {{ $ticket->status->name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.ticket.fields.priority') }}
                        </th>
                        <td>
                            {{ $ticket->priority->name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.ticket.fields.category') }}
                        </th>
                        <td>
                            {{ $ticket->category->name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.ticket.fields.author_name') }}
                        </th>
                        <td>
                            {{ $ticket->author_name }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.ticket.fields.author_email') }}
                        </th>
                        <td>
                            {{ $ticket->author_email }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.ticket.fields.assigned_to_user') }}
                        </th>
                        <td>
                            {{ $ticket->assigned_to_user->name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.ticket.fields.comments') }}
                        </th>
                        <td>
                            @forelse ($ticket->comments as $comment)
                                <div class="row">
                                    <div class="col">
                                        <p class="font-weight-bold"><a href="mailto:{{ $comment->author_email }}">{{ $comment->author_name }}</a> ({{ $comment->created_at }})</p>
                                        <p>{{ $comment->comment_text }}</p>
                                    </div>
                                </div>
                                <hr />
                            @empty
                                <div class="row">
                                    <div class="col">
                                        <p>There are no comments.</p>
                                    </div>
                                </div>
                                <hr />
                            @endforelse
                            <form action="{{ route('users.tickets.storeComment', $ticket->id) }}" method="POST">
                                @csrf
                                <div class="form-group">
                                    <label for="comment_text">Leave a comment</label>
                                    <textarea class="form-control" id="comment_text" name="comment_text" rows="3" required></textarea>
                                </div>
                                <button type="submit" class="btn btn-primary">@lang('global.submit')</button>
                            </form>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
        <hr>
        <div class="row">
            <div class="col-6">
                <a class="btn btn-warning my-2" href="{{ route('users.tickets.index') }}" style="min-width: 120px;">
                    {{ trans('global.back') }}
                </a>
            </div>

            <div class="col-6 text-right">
                <a href="{{ route('users.tickets.edit', $ticket->id) }}" class="btn btn-primary" style="min-width: 120px;">
                    @lang('global.edit') @lang('cruds.ticket.title_singular')
                </a>
            </div>
        </div>

        <nav class="mb-3">
            <div class="nav nav-tabs">

            </div>
        </nav>
    </div>
</div>
@endsection