@if ($row->information && $row->information->photo_url)
    <a href="/storage/{{ $row->information->photo_url }}" target="__new" rel="noopener noreferrer">
        <img src="/storage/{{ $row->information->photo_url }}" class="img-thumbnail rounded-circle" alt="Image" width="40" height="20">
    </a>
@else
    
@endif