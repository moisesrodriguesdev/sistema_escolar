@forelse ($students as $student)
    <li>{{ $student->name }}</li>
@empty
    <p>Não há estudantes cadastrados.</p>
@endforelse
