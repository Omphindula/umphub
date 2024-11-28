<?php
// Include header
include('includes/header.php');

// Fetch events from database (for demonstration, replace with your actual query)
$events = [
    [
        'title' => 'Math Exam',
        'date' => '2024-12-01',
        'description' => 'Mathematics final exam for all students.'
    ],
    [
        'title' => 'Student Council Meeting',
        'date' => '2024-12-03',
        'description' => 'Monthly meeting for the student council.'
    ],
    [
        'title' => 'Holiday',
        'date' => '2024-12-25',
        'description' => 'Christmas holiday, no classes.'
    ]
];
?>

<div class="container mt-5">
    <h2 class="text-center">Event Calendar</h2>
    
    <!-- Calendar -->
    <div id="calendar"></div>

    <!-- Upcoming Events Section -->
    <h3 class="mt-5">Upcoming Events</h3>
    <ul class="list-unstyled" id="event-list">
        <?php foreach ($events as $event): ?>
            <li class="mb-3">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title"><?php echo htmlentities($event['title']); ?></h5>
                        <p class="card-text"><?php echo htmlentities($event['description']); ?></p>
                        <p><strong>Event Date:</strong> <?php echo htmlentities($event['date']); ?></p>
                        <p><strong>Time Left:</strong> <span class="countdown" data-event-date="<?php echo $event['date']; ?>"></span></p>
                    </div>
                </div>
            </li>
        <?php endforeach; ?>
    </ul>

    <!-- Include FullCalendar CSS -->
    <link href="https://cdn.jsdelivr.net/npm/fullcalendar@5.11.0/main.min.css" rel="stylesheet" />
    
    <!-- Include FullCalendar JS -->
    <script src="https://cdn.jsdelivr.net/npm/fullcalendar@5.11.0/main.min.js"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Initialize the calendar
            var calendarEl = document.getElementById('calendar');

            var calendar = new FullCalendar.Calendar(calendarEl, {
                initialView: 'dayGridMonth',
                headerToolbar: {
                    left: 'prev,next today',
                    center: 'title',
                    right: 'dayGridMonth,timeGridWeek,timeGridDay'
                },
                events: [
                    {
                        title: 'Math Exam',
                        start: '2024-12-01',
                        description: 'Mathematics final exam for all students.'
                    },
                    {
                        title: 'Student Council Meeting',
                        start: '2024-12-03',
                        description: 'Monthly meeting for the student council.'
                    },
                    {
                        title: 'Holiday',
                        start: '2024-12-25',
                        description: 'Christmas holiday, no classes.'
                    }
                ],
                eventClick: function(info) {
                    alert('Event: ' + info.event.title + '\nDescription: ' + info.event.extendedProps.description);
                }
            });

            calendar.render();

            // Countdown timer logic
            function updateCountdowns() {
                const countdowns = document.querySelectorAll('.countdown');
                countdowns.forEach(function(countdown) {
                    const eventDate = new Date(countdown.getAttribute('data-event-date'));
                    const now = new Date();
                    const diff = eventDate - now;

                    if (diff > 0) {
                        const days = Math.floor(diff / (1000 * 60 * 60 * 24));
                        const hours = Math.floor((diff % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
                        const minutes = Math.floor((diff % (1000 * 60 * 60)) / (1000 * 60));
                        const seconds = Math.floor((diff % (1000 * 60)) / 1000);
                        
                        countdown.innerHTML = `${days}d ${hours}h ${minutes}m ${seconds}s`;
                    } else {
                        countdown.innerHTML = "Event has passed";
                    }
                });
            }

            // Update countdowns every second
            setInterval(updateCountdowns, 1000);
        });
    </script>
</div>

<?php
// Include footer
include('footer.php');
?>
