<h2>Hej!</h2>
<p>Masz zadanie zaplanowane na jutro:</p>

<ul>
    <li><strong>Nazwa:</strong> {{ $task->name }}</li>
    <li><strong>Priorytet:</strong> {{ $task->priority }}</li>
    <li><strong>Termin:</strong> {{ $task->due_date->format('Y-m-d') }}</li>
</ul>

<p>Nie zapomnij go zrealizować!</p>
