<div id="deleteModal" class="fixed inset-0 flex items-center max-h-screen justify-center bg-black bg-opacity-50 hidden">
    <div class="bg-zinc-100 dark:bg-zinc-900 w-1/2 rounded-md">
        <div class="p-4 border-b">
            <h2 class="text-lg font-medium text-zinc-900 dark:text-zinc-100">{{ __('Confirmar Exclusão') }}</h2>
        </div>
        <form id="deleteForm" method="POST" class="p-4">
            @csrf
            @method('delete')
            <h2  id="modalMessage" class="text-lg font-medium text-zinc-900 dark:text-zinc-100">
                {{ __('Você tem certeza que deseja excluir esse item?') }}
            </h2>
            <p class="mt-1 text-sm text-zinc-600 dark:text-zinc-400">
                {{ __('Esta ação não pode ser desfeita.') }}
            </p>
            <div class="mt-4 text-right">
                <x-secondary-button onclick="closeDeleteModal()">
                    {{ __('Cancelar') }}
                </x-secondary-button>

                <x-danger-button class="ms-3">
                    {{ __('Excluir') }}
                </x-danger-button>
            </div>
        </form>
    </div>
</div>

<!-- Script para abrir/fechar o modal dinamicamente -->
<script>
    function openDeleteModal(frase,url) {
        // Atualiza a mensagem do modal
        const modalMessage = document.getElementById('modalMessage');
        modalMessage.textContent = url;
        // Atualiza o formulário com o ID correto
        const form = document.getElementById('deleteModal');
        form.action = url; // Substitua pelo route correto

        // Exibe o modal
        document.getElementById('deleteModal').classList.remove('hidden');
    }

    function closeDeleteModal() {
        document.getElementById('deleteModal').classList.add('hidden');
    }
</script>