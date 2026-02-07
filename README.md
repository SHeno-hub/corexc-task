## Hotel Aggregator Service (Native PHP)

This project is a high-performance technical assessment built with Pure Native PHP. It demonstrates expertise in SOLID principles, design patterns, and efficient data aggregation without the overhead of a framework.
## Core Requirements Met

* Data Aggregation: Seamlessly consolidates data from 3 different API providers using Native cURL.

* Clean Architecture: Built from scratch with a custom PSR-4 autoloader via Composer.

* Data Consistency: Normalizes varied JSON structures (e.g., total vs totalPrice) into a unified DTO (Data  Transfer Object) format.

* Deduplication & Logic: Merges rooms with the same code per hotel and provides a unified view, ensuring the lowest price is prioritized if duplicates exist across different source formats.

* Performance: Optimized sorting and merging logic to handle multiple data streams efficiently.

* Reliability: Implements graceful error handling; if one API fails, the service continues to provide results from the others.

* Advanced Frontend: Interactive dashboard with real-time live search, price range filtering, and multi-currency conversion (USD/EGP)

## Architectural Decisions (SOLID & OOP)

* Strategy Pattern: Every advertiser is a unique Provider class implementing HotelProviderInterface. Adding a 4th advertiser is as simple as adding a new class.

* Dependency Inversion: The HotelService depends on abstractions (Interfaces) rather than concrete implementations.

* DRY Principle: An AbstractProvider handles the common cURL logic to prevent code duplication.

* Price Normalization: Since providers send different keys, the system dynamically normalizes these into a single total_price field in the DTO for consistency.

* Decoupled Architecture: Separation of concerns between the Backend API and the Frontend UI via JSON contracts

## Assumptions & Considerations

* Native Implementation: Chose Native cURL over external libraries to demonstrate core PHP proficiency and minimize external dependencies, fulfilling the "Native PHP" challenge requirement.

* Fault Tolerance: If a specific advertiser API is slow or down, the system is designed to return data from the remaining functional providers instead of failing the entire request.

* Validation: Each DTO is strictly typed to ensure no malformed data reaches the final output.

## Tech Stack

| Feature | Technology |
| :--- | :--- |
|**Language** | Native PHP 8.3 |
|**Dependency Manager** | Composer (for PSR-4 Autoloading) |
|**Transport** | Native cURL |
|**Frontend** | HTML5, Bootstrap 5, and jQuery (AJAX integration) |
|**Data Format** | JSON |

**UI Access**: Available at `http://localhost:8000/index.html`

## Installation and Setup

1. Clone the repository:
   git clone https://github.com/SHeno-hub/corexc-task.git
   
2. Install dependencies (Autoloader):
    composer install

3. Execution:
    Run the PHP built-in server:
    php -S localhost:8000 -t public

    API Endpoint: http://localhost:8000/api.php
    Web Interface: http://localhost:8000/index.html

## Testing & Verification

    Manual Testing: The endpoint has been verified using Postman and Browser testing to ensure JSON integrity and sorting accuracy.

## API Response Format
   ``` JSON
    [
        {
            "name": "Hotel C",
            "room_code": "SNG-RM",
            "total_price": 92,
            "source": "Advertiser 3"
        },
        {
            "name": "Hotel B",
            "room_code": "HF-BOD",
            "total_price": 103,
            "source": "Advertiser 2"
        }
    ]```