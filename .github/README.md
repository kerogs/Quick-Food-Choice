# Quick Food Choice
<div align="center">
    <img alt="" src="../.ksinf/logo.png" height="130px">
    <h3>Quick Food Choice</h3>
    <em>Web application for managing food orders in local events or networks</em>
</div>

## Description

**Quick Food Choice** is an intuitive web application designed to facilitate food order management. Originally developed for Five'sTv, it has now been reworked and improved for a broader audience, while maintaining its core functionalities. It offers a seamless communication system between clients, servers, and cooks, ensuring efficient order handling during events or in local restaurant settings.

The service works by hosting the site on a **local network**, where users can connect via tablets, phones, or computers. It is recommended to use the provided applications, but it can also be accessed via a browser.

## Key Features
- **Client, Server, Administrator Applications**: Standalone Python executables for streamlined interactions.
- **No Database Required**: The system operates without needing a backend database, ensuring simplicity and speed.
- **New Framework**: Now built with the latest version of **KerogsPHP-F**.
- **MPL 2.0 License**: The project remains open-source and is licensed under MPL 2.0.

## Quick Setup Guide
1. Run the application on a local network.
2. Connect to the site using a tablet, phone, or computer via the local network.
3. That's it—you're good to go!

**Recommended**: Use the provided applications for the best experience or access the site via a browser.

## Usage Guide
- **Network Setup**: Ensure the network is configured so that only the site is accessible through the tablets.
- **Client Orders**: When customers arrive, they should place their orders via a pre-configured tablet with the application already running. If possible, configure the tablets so that users cannot exit the app.
- **Cook Interface**: Cooks should use a touchscreen display to quickly update order statuses.  
  **Alternative**: Cooks can have the site open and be logged in as cooks to validate orders and change their statuses to "in preparation."

## Administrator Settings
As an administrator, you can:
- Add accounts for cooks.
- Display order statuses to clients.
- Show priority levels on orders (if an order is not being prepared after some time, it will change color to indicate that the customer has been waiting for a while).

## Installation

### Default Installation

1. Clone the repository:
    ```bash
    git clone https://github.com/kerogs/quickfoodchoice.git
    ```
2. Navigate to the project directory:
    ```bash
    cd quickfoodchoice
    ```
3. Install the required NPM packages:
    ```bash
    npm install
    ```
4. Install the Composer packages:
    ```bash
    composer install
    ```
5. Configure necessary information in `config.yml` (if you know what you do).
6. Run the application locally using MAMP, WAMP, or other local server software.
    - *The site also runs on a public network. However, keep in mind that this is not its primary objective.*

## Contribution

Contributions are welcome! Follow these steps to contribute:

1. Fork the repository.
2. Create a feature branch (`git checkout -b feature/AmazingFeature`).
3. Commit your changes (`git commit -m 'Add some AmazingFeature'`).
4. Push your branch (`git push origin feature/AmazingFeature`).
5. Open a Pull Request.

## License

Distributed under the MPL-2.0 License. See `LICENSE` for more information.

## Contact

For any questions, feel free to open an issue.

<p align="center">
  <img align="center" src="../.ksinf/fivestv.png" width="100" />
  <img align="center" src="../.ksinf/kslabs.png" width="100" /> 
</p>
