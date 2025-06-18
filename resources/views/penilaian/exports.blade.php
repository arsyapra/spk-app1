<table>
    <thead>
        <tr>
            <th><strong>Alternatif</strong></th>
            @foreach ($kriteria as $k)
                <th><strong>{{ $k->nama_kriteria }}</strong></th>
            @endforeach
        </tr>
    </thead>
    <tbody>
        @foreach ($alternatif as $alt)
            <tr>
                <td>{{ $alt->nama_alternatif }}</td>
                @foreach ($kriteria as $k)
                    @php
                        $nilai = $alt->penilaian->where('kriteria_id', $k->id)->first();
                    @endphp
                    <td>{{ $nilai?->sub_kriteria?->nama_sub_kriteria ?? '-' }}</td>
                @endforeach
            </tr>
        @endforeach
    </tbody>
</table>
