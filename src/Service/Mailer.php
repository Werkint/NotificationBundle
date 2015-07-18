<?php
namespace Werkint\Bundle\NotificationBundle\Service;

use Symfony\Component\Translation\TranslatorInterface;
use Werkint\Bundle\NotificationBundle\Service\Model\LocaleAwareUserInterface;

/**
 * Mailer.
 *
 * @author Bogdan Yurov <bogdan@yurov.me>
 */
class Mailer
{
    protected $templating;
    protected $translator;

    /**
     * @param \Twig_Environment   $templating
     * @param TranslatorInterface $translator
     */
    public function __construct(
        \Twig_Environment $templating,
        TranslatorInterface $translator
    ) {
        $this->templating = $templating;
        $this->translator = $translator;
    }

    /**
     * @param string                   $template
     * @param array                    $parameters
     * @param LocaleAwareUserInterface $target
     * @param array                    $ignoredHandlers
     */
    public function sendMessage(
        $template,
        array $parameters,
        LocaleAwareUserInterface $target,
        array $ignoredHandlers = []
    ) {
        $loc = $this->translator->getLocale();
        if ($target->getDefaultLocale()) {
            $this->translator->setLocale($target->getDefaultLocale());
        }
        // render
        $template = $this->loadTemplate($template);

        $parameters += [
            'user' => $target,
        ];
        $parameters = $this->templating->mergeGlobals($parameters);

        foreach ($this->handlers as $name => $handler) {
            if (in_array($name, $ignoredHandlers)) {
                continue;
            }
            $data = trim($template->renderBlock('body_' . $name, $parameters));
            if (!$data) {
                continue;
            }

            // Отсылаем
            // TODO: maybe do some log?
            $handler->sendMessage(
                $data,
                $target,
                $template,
                $parameters
            );
        }
        $this->translator->setLocale($loc);
    }

    /**
     * @param string $template
     * @return \Twig_Template
     */
    protected function loadTemplate($template)
    {
        return $this->templating->loadTemplate($template);
    }

    // -- Setters ---------------------------------------

    /** @var HandlerInterface[] */
    protected $handlers = [];

    /**
     * @param HandlerInterface $handler
     * @param                  $name
     */
    public function addHandler(HandlerInterface $handler, $name)
    {
        $this->handlers[$name] = $handler;
    }
} 