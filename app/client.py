import sys
from PyQt5.QtCore import QUrl, QTimer
from PyQt5.QtWidgets import QApplication, QMainWindow, QVBoxLayout, QWidget, QLabel
from PyQt5.QtWebEngineWidgets import QWebEngineView


class FullScreenBrowser(QMainWindow):
    def __init__(self, url, default_html, error_html):
        super().__init__()

        # Créer un widget central pour le navigateur
        self.central_widget = QWidget()
        self.setCentralWidget(self.central_widget)
        self.layout = QVBoxLayout(self.central_widget)

        # Créer un widget de navigation web
        self.browser = QWebEngineView()
        self.layout.addWidget(self.browser)

        # Connecter les signaux de chargement
        self.browser.loadFinished.connect(self.on_load_finished)

        # Afficher le contenu HTML par défaut
        self.browser.setHtml(default_html)

        # Afficher l'application en plein écran
        self.showFullScreen()

        # Tenter de charger l'URL après un court délai
        QTimer.singleShot(100, lambda: self.load_url(url))  # Délai de 100 ms

    def load_url(self, url):
        print("Chargement de l'URL :", url)  # Debugging
        self.browser.setUrl(QUrl(url))  # Charger l'URL

    def on_load_finished(self, success):
        if not success:
            print("Erreur de chargement, affichage de la page d'erreur.")  # Debugging
            self.browser.setHtml(error_html)  # Afficher le contenu d'erreur
        else:
            print("Chargement réussi.")  # Debugging


if __name__ == '__main__':
    app = QApplication(sys.argv)

    # URL du site web que vous voulez afficher
    site_url = 'https://www.example.ksnetcom'  # Remplacez par une URL valide

    # HTML par défaut à afficher pendant le chargement
    default_html = """<!doctype html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta content="width=device-width,initial-scale=1" name="viewport">
        <title>QuickFoodChoice | Loading...</title>
        <style>
            * { font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; margin: 0; padding: 0; }
            body { background-color: #fff; height: 100vh; display: flex; justify-content: center; align-items: center; }
            #wifi-loader { width: 64px; height: 64px; border-radius: 50px; position: relative; display: flex; justify-content: center; align-items: center; transform: scale(1.2); }
            /* Vos styles existants ici */
        </style>
    </head>
    <body>
        <div id="wifi-loader">
            <svg class="circle-outer" viewBox="0 0 86 86">
                <circle class="back" cx="43" cy="43" r="40"></circle>
                <circle class="front" cx="43" cy="43" r="40"></circle>
            </svg>
            <div class="text" data-text="Connecting..."></div>
        </div>
    </body>
    </html>"""

    # HTML à afficher en cas d'erreur
    error_html = """<!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width,initial-scale=1">
        <title>QuickFoodChoice | Error</title>
        <style>
            :root { --background: #62abff; --front-color: #4f29f0; --back-color: #c3c8de; --text-color: #414856; }
            * { font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; margin: 0; padding: 0; }
            body { background-color: #fff; height: 100vh; display: flex; justify-content: center; align-items: center; }
            .ccenter { display: flex; flex-direction: column; align-items: center; justify-content: center; height: 100vh; }
            .error h1 { color: var(--front-color); }
            .error p { margin: 10px 0 30px 0; font-size: 20px; }
            .bugreport { background-color: #4f29f020; padding: 10px; border-radius: 6px; }
            .bugreport > p { cursor: pointer; font-size: 20px; font-weight: bolder; margin: 0 0 10px 0; }
        </style>
    </head>
    <body>
        <div class="ccenter">
            <div class="error">
                <h1>Problem occurred.</h1>
                <p>An error has occurred. Please notify an employee</p>
            </div>
            <div class="bugreport">
                <p>Error details</p>
                <div id="buginfo">
                    <p>The application cannot contact the web server.</p>
                </div>
            </div>
        </div>
    </body>
    </html>"""

    # Créer l'application avec le site web et les contenus HTML
    browser_window = FullScreenBrowser(site_url, default_html, error_html)

    # Lancer l'application
    sys.exit(app.exec_())
