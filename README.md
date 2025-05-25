# Content Scheduler - Laravel Project

## Overview

This project is a simplified content scheduling application built with Laravel. It allows users to create, schedule, and manage posts across multiple social platforms. The app uses Laravel Sanctum for authentication and Blade for frontend views.

## Features

-   User authentication (register, login, logout) using Laravel Sanctum.
-   Models and migrations created for Users, Posts, Platforms, and pivot table PostPlatform.
-   Relationships between models properly defined (e.g. Many-to-Many between Users and Platforms, Posts and Platforms).
-   CRUD operations for posts with platform selection.
-   Scheduling posts with date/time picker.
-   Filtering posts by status and date.
-   Managing subscribed platforms for users.
-   Validation for post inputs and platform selection.
-   Blade-based frontend for all pages (auth, post editor, platform management, dashboard).
-   Character counter for post content.
-   Scheduled posts processing via Laravel commands/jobs (mock publishing).
-   Responsive and clean UI design using Tailwind CSS.

## Installation

1. Clone the repository:

    ```bash
    https://github.com/Ahmed1230000/Content-Scheduler.git
    ```

    ### 📝 Activity Logging

I implemented activity logging using the [spatie/laravel-activitylog](https://github.com/spatie/laravel-activitylog) package to track important user actions within the system. This helps in monitoring user behavior and debugging issues efficiently.

The logging functionality was applied inside the `AuthRepository` following the **Repository Pattern**. The following events are recorded:

-   **User Registration**: Logs the newly registered user's email and selected platforms.
-   **User Login**: Logs the email of the user who logged in.
-   **User Logout**: Logs when a user logs out.

Each event is logged using the `activity()` helper, associating the action with the authenticated user and storing relevant properties.

#### Example usage:

```php
activity('auth')
    ->causedBy($user)
    ->withProperties(['email' => $user->email])
    ->log('User logged in');
```

### 🔍 Filtering with Spatie Query Builder

To enable advanced filtering functionality in the posts listing, I used the spatie/laravel-query-builder package.

-   \*\*This allows filtering user posts based on:
-   \*\*Status (draft, scheduled, published)
-   \*\*Date
-   \*\*Platform

It keeps the controller clean and ensures that query logic is flexible and secure

### Example usage:

```php
use Spatie\QueryBuilder\QueryBuilder;

$posts = QueryBuilder::for(Post::class)
    ->allowedFilters(['status', 'platform_id'])
    ->where('user_id', auth()->id())
    ->get();
```

### Example request:

```bash
GET /posts?filter[status]=scheduled&filter[platform_id]=1
```
