<style>
.navbar {
    position: fixed;
    top: 0;
    left: 250px;
    width: calc(100% - 250px);
    height: 60px;
    background: #AD1457;
    display: flex;
    align-items: center;
    padding: 0 20px;
    z-index: 1000;
}
.calendar-container {
    margin-top: 80px;
    padding: 20px;
    background: white;
    border-radius: 10px;
    box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.1);
    width: 100%;
    max-width: 1400px;
}

.sidebar {
    width: 250px;
    height: 100vh;
    position: fixed;
    top: 0;
    left: 0;
    background: #880E4F;
    color: white;
    padding-top: 20px;
}

.main-content {
    margin-left: 260px;
    padding: 20px;
}

.notifications {
    position: absolute;
    right: 20px;
    top: 80px;
    font-size: 14px;
    color: #333;
}
.calendar-container {
    width: 100% !important;
    max-width: 100% !important;
    padding: 20px;
    background: transparent;
    border-radius: 10px;
    box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.1);
}

#calendar {
    width: 100% !important;
    min-height: 600px;
}
.main-content {
    margin-left: 300px;
    padding: 20px;
    width: calc(200% - 300px);
}

.fc {
    background-color: white !important;
    opacity: 1 !important;
}

.fc-daygrid-day-number, .fc-col-header-cell {
    color: black !important;
    font-weight: bold;
}
.fc-toolbar-title {
    font-size: 20px !important;
    font-weight: bold;
    color: #333;
    text-align: center;
}
.fc-button {
    background-color: #AD1457 !important;
    color: white !important;
    border-radius: 5px !important;
    padding: 8px 12px;
}

.fc-button:hover {
    background-color: #AD1457 !important;
}
.fc-timegrid-slot-label {
    white-space: nowrap;
    font-size: 13px;
    color: #333;
}
.fc-timegrid-slot {
    font-size: 14px !important;
    font-weight: bold;
    text-align: center;
    padding: 5px;
}
.fc-event-time {
    font-size: 14px !important;
    font-weight: bold;
    color: #333;
}

    </style>