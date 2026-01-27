@props(['headers' => []])

<div class="overflow-x-auto">
    <table class="min-w-full bg-white border-collapse">
        <thead class="bg-slate-50 border-b border-slate-200">
            <tr>
                @foreach($headers as $header)
                    <th class="px-6 py-4 text-left text-xs font-semibold text-slate-700 uppercase tracking-wide">
                        {{ $header }}
                    </th>
                @endforeach
                <th class="px-6 py-4 text-left text-xs font-semibold text-slate-700 uppercase tracking-wide">
                    Acciones
                </th>
            </tr>
        </thead>
        <tbody>
            {{ $slot }}
        </tbody>
    </table>
</div>
