@admin
<a href="{{ Route('dashboard.categories.edit', $id) }}"  class="btn btn-outline btn-sm" >
    <i class="fa fa-edit "></i>
</a>

<a class="btn btn-outline btn-sm btn-delete" onclick="confirmDelete({{$id}})">
    <i class="fa fa-trash-can text-danger" ></i>
</a>

<form action="{{ route('dashboard.categories.destroy', $id) }}" method="post" id={{$id}}>
    {{ csrf_field() }}
    @method('DELETE')
</form>
@endadmin