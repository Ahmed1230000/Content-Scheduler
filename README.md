# Content Scheduler - Laravel Project

## Overview
This project is a simplified content scheduling application built with Laravel. It allows users to create, schedule, and manage posts across multiple social platforms. The app uses Laravel Sanctum for authentication and Blade for frontend views.

## Features
- User authentication (register, login, logout) using Laravel Sanctum.
- Models and migrations created for Users, Posts, Platforms, and pivot table PostPlatform.
- Relationships between models properly defined (e.g. Many-to-Many between Users and Platforms, Posts and Platforms).
- CRUD operations for posts with platform selection.
- Scheduling posts with date/time picker.
- Filtering posts by status and date.
- Managing subscribed platforms for users.
- Validation for post inputs and platform selection.
- Blade-based frontend for all pages (auth, post editor, platform management, dashboard).
- Character counter for post content.
- Scheduled posts processing via Laravel commands/jobs (mock publishing).
- Responsive and clean UI design using Tailwind CSS.

## Installation
1. Clone the repository:
   ```bash
   https://github.com/Ahmed1230000/Content-Scheduler.git
