@admin
<a href="{{ Route('dashboard.testimonials.edit', $id) }}"  class="btn btn-outline btn-sm" >
    <i class="fa fa-edit"></i>
</a>

<a class="btn btn-outline btn-sm btn-delete" onclick="confirmDelete({{$id}})">
    <i class="fa fa-trash-can text-danger" ></i>
</a>

<form action="{{ route('dashboard.testimonials.destroy', $id) }}" method="post" id={{$id}}>
    {{ csrf_field() }}
    @method('DELETE')
</form>
@endadmin