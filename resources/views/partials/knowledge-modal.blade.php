@if($page = \Anonimatrix\Knowledge\Services\KnowledgeService::getCurrentRouteArticle())
    <style>
        .knowledge-modal {
            position: fixed;
            right: 0;
            bottom: 0;
            z-index: 10001;
            width: max-content;
            height: max-content;
        }

        .knowledge-modal__container {
            display: flex;
            align-items: flex-end;
            justify-content: flex-end;
            height: 100%;
        }

        .knowledge-modal__card {
            background-color: #fff;
            padding: 20px 30px;
            margin: 10px;
            border-radius: 16px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.5);
            max-width: 95vw;
            width: 100%;
            max-height: 80vh;
            overflow-y: auto;
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        @media only screen and (min-width: 600px) {
        .knowledge-modal__card {
            max-width: 450px;
            }
        }

        .knowledge-modal__title {
            margin: 20;
            font-size: 18px;
            font-weight: 600;
            text-align: center;
        }

        .knowledge-modal__message {
            margin: 0;
            font-size: 14px;
            line-height: 1.5;
        }

        .knowledge-modal__link {
            margin: 20px 0;
            font-size: 14px;
            background-color: #007bff;
            color: white;
            text-decoration: none;

            padding: 10px 20px;
            border-radius: 8px;
        }

        .knowledge-modal__close-button {
            position: absolute;
            top: 14px;
            right: 18px;
            border: none;
            background-color: transparent;
            font-size: 16px;
            cursor: pointer;
        }

        .knowledge-modal__close-button:hover {
            color: #007bff;
        }

    </style>

    <script>
        function closeKnowledgeModal() {
            document.querySelector('.knowledge-modal').style.display = 'none';
        }
    </script>

    <div class="knowledge-modal">
        <div class="knowledge-modal__container">
            <div class="knowledge-modal__card">
                <h5 class="knowledge-modal__title">{{__('knowledge.help-title')}}</h5>
                <p class="knowledge-modal__message">{{__('knowledge.help-message')}}</p>
                <a target="_blank" class="knowledge-modal__link" href="{{ route('knowledge.articles', ['id' => $page->id]) }}">{{__('knowledge.go-to-help-page')}}</a>
                <button id="close" class="knowledge-modal__close-button" onclick="closeKnowledgeModal()">X</button>
            </div>
        </div>
    </div>
@endif