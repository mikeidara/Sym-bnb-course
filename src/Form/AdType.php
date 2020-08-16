<?php

namespace App\Form;

use App\Entity\Ad;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\MoneyType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\UrlType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class AdType extends AbstractType
{
    /**
     * @param [String] $title
     * @param [String] $placeholder
     * @return Array
     */
    private function getConfiguration($title, $placeholder)
    {
        return [
            'label' => $title,
            'attr' => [
                'placeholder' => $placeholder,
            ],
        ];
    }

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title', TextType::class, $this->getConfiguration("Titre", "Titre de l'annonce"))
            ->add('slug', TextType::class, $this->getConfiguration("Chaine url", "Automatique"))
            ->add('coverImage', UrlType::class, $this->getConfiguration("Url de l'image", "Donnez l'adresse de l'image"))
            ->add('introduction', TextType::class, $this->getConfiguration("Introduction", "Donnez une description"))
            ->add('content', TextareaType::class, $this->getConfiguration("Contenu", "Description détaillé"))
            ->add('price', MoneyType::class, $this->getConfiguration("Prix", "Prix du bien"))
            ->add('rooms', IntegerType::class, $this->getConfiguration("Nombre de chambre", "Entrez le nombre de chambre"));
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Ad::class,
        ]);
    }
}
