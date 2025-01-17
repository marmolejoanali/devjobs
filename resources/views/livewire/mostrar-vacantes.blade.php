<div>
    <div class="bg-white overflow-hidden shadow-sm dark:bg-gray-800 sm:rounded-lg">
        @forelse($vacantes as $vacante)
        <div class="p-6 bg-white border-b border-gray-200 md:flex md:justify-between md:items-center">
            <div class="space-y-3">
                <a href="{{ route('vacantes.show',$vacante) }}" class="text-xl font-bold"> {{$vacante->titulo}}</a>
                <p class="text-sm font-bold text-gray-600">{{$vacante->empresa}}</p>
                <p class="text-sm text-gray-500">Último día: {{ $vacante->ultimo_dia->format('d/m/Y') }}</p>
            </div>

            <div class="flex flex-col md:flex-row items-stretch text-center gap-3 mt-5 md:mt-0">
                <a href="{{ route('candidatos.index',$vacante) }}" class="bg-slate-800 py-2 px-4 rounded-lg text-white text-xs font-bold uppercase">
                    {{ $vacante->candidatos->count() }} Candidatos
                </a>

                <a href="{{ route('vacantes.edit',$vacante->id) }}" class="bg-blue-800 py-2 px-4 rounded-lg text-white text-xs font-bold uppercase">
                    Editar
                </a>

                <button wire:click="$emit('mostrarAlerta',{{ $vacante->id }})" class="bg-red-600 py-2 px-4 rounded-lg text-white text-xs font-bold uppercase">
                    Eliminar
                </button>

            </div>
        </div>

        @empty
        <P class="p-6 text-center text-sm text-gray-600 ">No hay vacantes</P>
        @endforelse
    </div>

    <div class=" mt-6">
        {{ $vacantes->links() }}
    </div>
</div>
@push('scripts')

<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>


<script>
    Livewire.on('mostrarAlerta', vacanteId => {
        console.log(vacanteId);


        Swal.fire({
            title: '¿Eliminar vacante?'
            , text: "Una vacante eliminada no se puede recuperar!"
            , icon: 'warning'
            , showCancelButton: true
            , confirmButtonColor: '#3085d6'
            , cancelButtonColor: '#d33'
            , confirmButtonText: 'Si, ¡Eliminar!'
            , cancelButtontext: 'Cancelar'
        }).then((result) => {
            if (result.isConfirmed) {
                Livewire.emit('eliminarVacante', vacanteId);
                Swal.fire(
                    'Se elimino la vacante!'
                    , 'Eliminado Correctamente.'
                    , 'success'
                )
            }
        })
    });

</script>




@endpush
