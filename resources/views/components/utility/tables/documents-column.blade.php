<div>
    @if($getState())
        @foreach ($getState() as $document)
            <a href="{{ Storage::url($document) }}" target="_blank" class="text-primary">
                Document {{ $loop->iteration }}
            </a>
            @if (!$loop->last) <br> @endif
        @endforeach
    @endif
</div>
