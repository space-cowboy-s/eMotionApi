<?php

use Symfony\Component\DependencyInjection\Argument\RewindableGenerator;
use Symfony\Component\DependencyInjection\Exception\RuntimeException;

// This file has been auto-generated by the Symfony Dependency Injection Component for internal use.
// Returns the public 'nelmio_alice.data_loader' shared service.

include_once $this->targetDirs[3].'/vendor/nelmio/alice/src/DataLoaderInterface.php';
include_once $this->targetDirs[3].'/vendor/nelmio/alice/src/IsAServiceTrait.php';
include_once $this->targetDirs[3].'/vendor/nelmio/alice/src/Loader/SimpleDataLoader.php';
include_once $this->targetDirs[3].'/vendor/nelmio/alice/src/FixtureBuilderInterface.php';
include_once $this->targetDirs[3].'/vendor/nelmio/alice/src/FixtureBuilder/SimpleBuilder.php';
include_once $this->targetDirs[3].'/vendor/nelmio/alice/src/FixtureBuilder/DenormalizerInterface.php';
include_once $this->targetDirs[3].'/vendor/nelmio/alice/src/FixtureBuilder/Denormalizer/SimpleDenormalizer.php';
include_once $this->targetDirs[3].'/vendor/nelmio/alice/src/FixtureBuilder/Denormalizer/ParameterBagDenormalizerInterface.php';
include_once $this->targetDirs[3].'/vendor/nelmio/alice/src/FixtureBuilder/Denormalizer/Parameter/SimpleParameterBagDenormalizer.php';
include_once $this->targetDirs[3].'/vendor/nelmio/alice/src/FixtureBuilder/Denormalizer/FixtureBagDenormalizerInterface.php';
include_once $this->targetDirs[3].'/vendor/nelmio/alice/src/FixtureBuilder/Denormalizer/Fixture/SimpleFixtureBagDenormalizer.php';
include_once $this->targetDirs[3].'/vendor/nelmio/alice/src/FixtureBuilder/Denormalizer/Fixture/FixtureDenormalizerInterface.php';
include_once $this->targetDirs[3].'/vendor/nelmio/alice/src/FixtureBuilder/Denormalizer/Fixture/TolerantFixtureDenormalizer.php';
include_once $this->targetDirs[3].'/vendor/nelmio/alice/src/FixtureBuilder/Denormalizer/Fixture/FixtureDenormalizerRegistry.php';
include_once $this->targetDirs[3].'/vendor/nelmio/alice/src/FixtureBuilder/Denormalizer/FlagParserInterface.php';
include_once $this->targetDirs[3].'/vendor/nelmio/alice/src/FixtureBuilder/Denormalizer/FlagParser/ElementFlagParser.php';
include_once $this->targetDirs[3].'/vendor/nelmio/alice/src/FixtureBuilder/Denormalizer/FlagParser/FlagParserRegistry.php';
include_once $this->targetDirs[3].'/vendor/nelmio/alice/src/FixtureBuilder/Denormalizer/FlagParser/ChainableFlagParserInterface.php';
include_once $this->targetDirs[3].'/vendor/nelmio/alice/src/FixtureBuilder/Denormalizer/FlagParser/Chainable/ConfiguratorFlagParser.php';
include_once $this->targetDirs[3].'/vendor/nelmio/alice/src/FixtureBuilder/Denormalizer/FlagParser/Chainable/ExtendFlagParser.php';
include_once $this->targetDirs[3].'/vendor/nelmio/alice/src/FixtureBuilder/Denormalizer/FlagParser/Chainable/OptionalFlagParser.php';
include_once $this->targetDirs[3].'/vendor/nelmio/alice/src/FixtureBuilder/Denormalizer/FlagParser/Chainable/TemplateFlagParser.php';
include_once $this->targetDirs[3].'/vendor/nelmio/alice/src/FixtureBuilder/Denormalizer/FlagParser/Chainable/UniqueFlagParser.php';
include_once $this->targetDirs[3].'/vendor/nelmio/alice/src/FixtureBuilder/Denormalizer/Fixture/ChainableFixtureDenormalizerInterface.php';
include_once $this->targetDirs[3].'/vendor/nelmio/alice/src/FixtureBuilder/Denormalizer/Fixture/Chainable/CollectionDenormalizer.php';
include_once $this->targetDirs[3].'/vendor/nelmio/alice/src/FixtureBuilder/Denormalizer/Fixture/FixtureDenormalizerAwareInterface.php';
include_once $this->targetDirs[3].'/vendor/nelmio/alice/src/FixtureBuilder/Denormalizer/FlagParserAwareInterface.php';
include_once $this->targetDirs[3].'/vendor/nelmio/alice/src/FixtureBuilder/Denormalizer/Fixture/Chainable/SimpleCollectionDenormalizer.php';
include_once $this->targetDirs[3].'/vendor/nelmio/alice/src/FixtureBuilder/Denormalizer/Fixture/Chainable/CollectionDenormalizerWithTemporaryFixture.php';
include_once $this->targetDirs[3].'/vendor/nelmio/alice/src/FixtureBuilder/Denormalizer/Fixture/Chainable/NullListNameDenormalizer.php';
include_once $this->targetDirs[3].'/vendor/nelmio/alice/src/FixtureBuilder/Denormalizer/Fixture/Chainable/ReferenceRangeNameDenormalizer.php';
include_once $this->targetDirs[3].'/vendor/nelmio/alice/src/FixtureBuilder/Denormalizer/Fixture/SpecificationsDenormalizerInterface.php';
include_once $this->targetDirs[3].'/vendor/nelmio/alice/src/FixtureBuilder/Denormalizer/Fixture/SpecificationBagDenormalizer/SimpleSpecificationsDenormalizer.php';
include_once $this->targetDirs[3].'/vendor/nelmio/alice/src/FixtureBuilder/Denormalizer/Fixture/SpecificationBagDenormalizer/ConstructorDenormalizerInterface.php';
include_once $this->targetDirs[3].'/vendor/nelmio/alice/src/FixtureBuilder/Denormalizer/Fixture/SpecificationBagDenormalizer/Constructor/LegacyConstructorDenormalizer.php';
include_once $this->targetDirs[3].'/vendor/nelmio/alice/src/FixtureBuilder/Denormalizer/Fixture/SpecificationBagDenormalizer/Constructor/ConstructorDenormalizer.php';
include_once $this->targetDirs[3].'/vendor/nelmio/alice/src/FixtureBuilder/Denormalizer/Fixture/SpecificationBagDenormalizer/ArgumentsDenormalizerInterface.php';
include_once $this->targetDirs[3].'/vendor/nelmio/alice/src/FixtureBuilder/Denormalizer/Fixture/SpecificationBagDenormalizer/Arguments/SimpleArgumentsDenormalizer.php';
include_once $this->targetDirs[3].'/vendor/nelmio/alice/src/FixtureBuilder/Denormalizer/Fixture/SpecificationBagDenormalizer/ValueDenormalizerInterface.php';
include_once $this->targetDirs[3].'/vendor/nelmio/alice/src/FixtureBuilder/Denormalizer/Fixture/SpecificationBagDenormalizer/Value/UniqueValueDenormalizer.php';
include_once $this->targetDirs[3].'/vendor/nelmio/alice/src/FixtureBuilder/Denormalizer/Fixture/SpecificationBagDenormalizer/Value/SimpleValueDenormalizer.php';
include_once $this->targetDirs[3].'/vendor/nelmio/alice/src/FixtureBuilder/ExpressionLanguage/ParserInterface.php';
include_once $this->targetDirs[3].'/vendor/nelmio/alice/src/FixtureBuilder/ExpressionLanguage/Parser/FunctionFixtureReferenceParser.php';
include_once $this->targetDirs[3].'/vendor/nelmio/alice/src/FixtureBuilder/ExpressionLanguage/Parser/StringMergerParser.php';
include_once $this->targetDirs[3].'/vendor/nelmio/alice/src/FixtureBuilder/ExpressionLanguage/Parser/SimpleParser.php';
include_once $this->targetDirs[3].'/vendor/nelmio/alice/src/FixtureBuilder/ExpressionLanguage/LexerInterface.php';
include_once $this->targetDirs[3].'/vendor/nelmio/alice/src/FixtureBuilder/ExpressionLanguage/Lexer/EmptyValueLexer.php';
include_once $this->targetDirs[3].'/vendor/nelmio/alice/src/FixtureBuilder/ExpressionLanguage/Lexer/ReferenceEscaperLexer.php';
include_once $this->targetDirs[3].'/vendor/nelmio/alice/src/FixtureBuilder/ExpressionLanguage/Lexer/GlobalPatternsLexer.php';
include_once $this->targetDirs[3].'/vendor/nelmio/alice/src/FixtureBuilder/ExpressionLanguage/Lexer/FunctionLexer.php';
include_once $this->targetDirs[3].'/vendor/nelmio/alice/src/FixtureBuilder/ExpressionLanguage/Lexer/StringThenReferenceLexer.php';
include_once $this->targetDirs[3].'/vendor/nelmio/alice/src/FixtureBuilder/ExpressionLanguage/Lexer/SubPatternsLexer.php';
include_once $this->targetDirs[3].'/vendor/nelmio/alice/src/FixtureBuilder/ExpressionLanguage/Lexer/ReferenceLexer.php';
include_once $this->targetDirs[3].'/vendor/nelmio/alice/src/FixtureBuilder/ExpressionLanguage/Parser/TokenParserInterface.php';
include_once $this->targetDirs[3].'/vendor/nelmio/alice/src/FixtureBuilder/ExpressionLanguage/ParserAwareInterface.php';
include_once $this->targetDirs[3].'/vendor/nelmio/alice/src/FixtureBuilder/ExpressionLanguage/Parser/TokenParser/TokenParserRegistry.php';
include_once $this->targetDirs[3].'/vendor/nelmio/alice/src/FixtureBuilder/ExpressionLanguage/Parser/ChainableTokenParserInterface.php';
include_once $this->targetDirs[3].'/vendor/nelmio/alice/src/FixtureBuilder/ExpressionLanguage/Parser/TokenParser/Chainable/AbstractChainableParserAwareParser.php';
include_once $this->targetDirs[3].'/vendor/nelmio/alice/src/FixtureBuilder/ExpressionLanguage/Parser/TokenParser/Chainable/DynamicArrayTokenParser.php';
include_once $this->targetDirs[3].'/vendor/nelmio/alice/src/FixtureBuilder/ExpressionLanguage/Parser/TokenParser/Chainable/EscapedValueTokenParser.php';
include_once $this->targetDirs[3].'/vendor/nelmio/alice/src/FixtureBuilder/ExpressionLanguage/Parser/TokenParser/Chainable/FixtureListReferenceTokenParser.php';
include_once $this->targetDirs[3].'/vendor/nelmio/alice/src/FixtureBuilder/ExpressionLanguage/Parser/TokenParser/Chainable/FixtureMethodReferenceTokenParser.php';
include_once $this->targetDirs[3].'/vendor/nelmio/alice/src/FixtureBuilder/ExpressionLanguage/Parser/TokenParser/Chainable/FixtureRangeReferenceTokenParser.php';
include_once $this->targetDirs[3].'/vendor/nelmio/alice/src/FixtureBuilder/ExpressionLanguage/Parser/TokenParser/Chainable/MethodReferenceTokenParser.php';
include_once $this->targetDirs[3].'/vendor/nelmio/alice/src/FixtureBuilder/ExpressionLanguage/Parser/TokenParser/Chainable/OptionalTokenParser.php';
include_once $this->targetDirs[3].'/vendor/nelmio/alice/src/FixtureBuilder/ExpressionLanguage/Parser/TokenParser/Chainable/ParameterTokenParser.php';
include_once $this->targetDirs[3].'/vendor/nelmio/alice/src/FixtureBuilder/ExpressionLanguage/Parser/TokenParser/Chainable/PropertyReferenceTokenParser.php';
include_once $this->targetDirs[3].'/vendor/nelmio/alice/src/FixtureBuilder/ExpressionLanguage/Parser/TokenParser/Chainable/VariableReferenceTokenParser.php';
include_once $this->targetDirs[3].'/vendor/nelmio/alice/src/FixtureBuilder/ExpressionLanguage/Parser/TokenParser/Chainable/SimpleReferenceTokenParser.php';
include_once $this->targetDirs[3].'/vendor/nelmio/alice/src/FixtureBuilder/ExpressionLanguage/Parser/TokenParser/Chainable/StringArrayTokenParser.php';
include_once $this->targetDirs[3].'/vendor/nelmio/alice/src/FixtureBuilder/ExpressionLanguage/Parser/TokenParser/Chainable/StringTokenParser.php';
include_once $this->targetDirs[3].'/vendor/nelmio/alice/src/FixtureBuilder/ExpressionLanguage/Parser/TokenParser/Chainable/ArgumentEscaper.php';
include_once $this->targetDirs[3].'/vendor/nelmio/alice/src/FixtureBuilder/ExpressionLanguage/Parser/TokenParser/Chainable/TolerantFunctionTokenParser.php';
include_once $this->targetDirs[3].'/vendor/nelmio/alice/src/FixtureBuilder/ExpressionLanguage/Parser/TokenParser/Chainable/IdentityTokenParser.php';
include_once $this->targetDirs[3].'/vendor/nelmio/alice/src/FixtureBuilder/ExpressionLanguage/Parser/TokenParser/Chainable/FunctionTokenParser.php';
include_once $this->targetDirs[3].'/vendor/nelmio/alice/src/FixtureBuilder/ExpressionLanguage/Parser/TokenParser/Chainable/VariableTokenParser.php';
include_once $this->targetDirs[3].'/vendor/nelmio/alice/src/FixtureBuilder/ExpressionLanguage/Parser/TokenParser/Chainable/WildcardReferenceTokenParser.php';
include_once $this->targetDirs[3].'/vendor/nelmio/alice/src/FixtureBuilder/Denormalizer/Fixture/SpecificationBagDenormalizer/Constructor/FactoryDenormalizer.php';
include_once $this->targetDirs[3].'/vendor/nelmio/alice/src/FixtureBuilder/Denormalizer/Fixture/SpecificationBagDenormalizer/CallsDenormalizerInterface.php';
include_once $this->targetDirs[3].'/vendor/nelmio/alice/src/FixtureBuilder/Denormalizer/Fixture/SpecificationBagDenormalizer/Calls/CallsWithFlagsDenormalizer.php';
include_once $this->targetDirs[3].'/vendor/nelmio/alice/src/FixtureBuilder/Denormalizer/Fixture/SpecificationBagDenormalizer/Calls/FunctionDenormalizer.php';
include_once $this->targetDirs[3].'/vendor/nelmio/alice/src/FixtureBuilder/Denormalizer/Fixture/SpecificationBagDenormalizer/Calls/MethodFlagHandler.php';
include_once $this->targetDirs[3].'/vendor/nelmio/alice/src/FixtureBuilder/Denormalizer/Fixture/SpecificationBagDenormalizer/Calls/MethodFlagHandler/ConfiguratorFlagHandler.php';
include_once $this->targetDirs[3].'/vendor/nelmio/alice/src/FixtureBuilder/Denormalizer/Fixture/SpecificationBagDenormalizer/Calls/MethodFlagHandler/OptionalFlagHandler.php';
include_once $this->targetDirs[3].'/vendor/nelmio/alice/src/FixtureBuilder/Denormalizer/Fixture/SpecificationBagDenormalizer/PropertyDenormalizerInterface.php';
include_once $this->targetDirs[3].'/vendor/nelmio/alice/src/FixtureBuilder/Denormalizer/Fixture/SpecificationBagDenormalizer/Property/SimplePropertyDenormalizer.php';
include_once $this->targetDirs[3].'/vendor/nelmio/alice/src/FixtureBuilder/Denormalizer/Fixture/Chainable/NullRangeNameDenormalizer.php';
include_once $this->targetDirs[3].'/vendor/nelmio/alice/src/FixtureBuilder/Denormalizer/Fixture/Chainable/SimpleDenormalizer.php';
include_once $this->targetDirs[3].'/vendor/nelmio/alice/src/GeneratorInterface.php';
include_once $this->targetDirs[3].'/vendor/nelmio/alice/src/Generator/DoublePassGenerator.php';
include_once $this->targetDirs[3].'/vendor/nelmio/alice/src/Generator/FixtureSetResolverInterface.php';
include_once $this->targetDirs[3].'/vendor/nelmio/alice/src/Generator/Resolver/FixtureSet/RemoveConflictingObjectsResolver.php';
include_once $this->targetDirs[3].'/vendor/nelmio/alice/src/Generator/Resolver/FixtureSet/SimpleFixtureSetResolver.php';
include_once $this->targetDirs[3].'/vendor/nelmio/alice/src/Generator/Resolver/ParameterBagResolverInterface.php';
include_once $this->targetDirs[3].'/vendor/nelmio/alice/src/Generator/Resolver/Parameter/RemoveConflictingParametersParameterBagResolver.php';
include_once $this->targetDirs[3].'/vendor/nelmio/alice/src/Generator/Resolver/Parameter/SimpleParameterBagResolver.php';
include_once $this->targetDirs[3].'/vendor/nelmio/alice/src/Generator/Resolver/ParameterResolverInterface.php';
include_once $this->targetDirs[3].'/vendor/nelmio/alice/src/Generator/Resolver/Parameter/ParameterResolverRegistry.php';
include_once $this->targetDirs[3].'/vendor/nelmio/alice/src/Generator/Resolver/ChainableParameterResolverInterface.php';
include_once $this->targetDirs[3].'/vendor/nelmio/alice/src/Generator/Resolver/Parameter/Chainable/StaticParameterResolver.php';
include_once $this->targetDirs[3].'/vendor/nelmio/alice/src/Generator/Resolver/ParameterResolverAwareInterface.php';
include_once $this->targetDirs[3].'/vendor/nelmio/alice/src/Generator/Resolver/Parameter/Chainable/ArrayParameterResolver.php';
include_once $this->targetDirs[3].'/vendor/nelmio/alice/src/Generator/Resolver/Parameter/Chainable/RecursiveParameterResolver.php';
include_once $this->targetDirs[3].'/vendor/nelmio/alice/src/Generator/Resolver/Parameter/Chainable/StringParameterResolver.php';
include_once $this->targetDirs[3].'/vendor/nelmio/alice/src/Generator/Resolver/FixtureBagResolverInterface.php';
include_once $this->targetDirs[3].'/vendor/nelmio/alice/src/Generator/Resolver/Fixture/TemplateFixtureBagResolver.php';
include_once $this->targetDirs[3].'/vendor/nelmio/alice/src/Generator/ObjectGeneratorInterface.php';
include_once $this->targetDirs[3].'/vendor/nelmio/alice/src/Generator/ObjectGenerator/CompleteObjectGenerator.php';
include_once $this->targetDirs[3].'/vendor/nelmio/alice/src/Generator/ObjectGenerator/SimpleObjectGenerator.php';
include_once $this->targetDirs[3].'/vendor/nelmio/alice/src/Generator/ValueResolverInterface.php';
include_once $this->targetDirs[3].'/vendor/nelmio/alice/src/Generator/ObjectGeneratorAwareInterface.php';
include_once $this->targetDirs[3].'/vendor/nelmio/alice/src/Generator/Resolver/Value/ValueResolverRegistry.php';
include_once $this->targetDirs[3].'/vendor/nelmio/alice/src/Generator/Resolver/Value/ChainableValueResolverInterface.php';
include_once $this->targetDirs[3].'/vendor/nelmio/alice/src/Generator/ValueResolverAwareInterface.php';
include_once $this->targetDirs[3].'/vendor/nelmio/alice/src/Generator/Resolver/Value/Chainable/ArrayValueResolver.php';
include_once $this->targetDirs[3].'/vendor/nelmio/alice/src/Generator/Resolver/Value/Chainable/DynamicArrayValueResolver.php';
include_once $this->targetDirs[3].'/vendor/nelmio/alice/src/Generator/Resolver/Value/Chainable/EvaluatedValueResolver.php';
include_once $this->targetDirs[3].'/vendor/nelmio/alice/src/Generator/Resolver/Value/Chainable/FunctionCallArgumentResolver.php';
include_once $this->targetDirs[3].'/vendor/nelmio/alice/src/Generator/Resolver/Value/Chainable/PhpFunctionCallValueResolver.php';
include_once $this->targetDirs[3].'/vendor/nelmio/alice/src/Generator/Resolver/Value/Chainable/FakerFunctionCallValueResolver.php';
include_once $this->targetDirs[3].'/vendor/nelmio/alice/src/Generator/Resolver/Value/Chainable/FixturePropertyReferenceResolver.php';
include_once $this->targetDirs[3].'/vendor/nelmio/alice/src/PropertyAccess/StdPropertyAccessor.php';
include_once $this->targetDirs[3].'/vendor/nelmio/alice/src/Generator/Resolver/Value/Chainable/FixtureMethodCallReferenceResolver.php';
include_once $this->targetDirs[3].'/vendor/nelmio/alice/src/Generator/Resolver/Value/Chainable/UnresolvedFixtureReferenceIdResolver.php';
include_once $this->targetDirs[3].'/vendor/nelmio/alice/src/Generator/Resolver/Value/Chainable/SelfFixtureReferenceResolver.php';
include_once $this->targetDirs[3].'/vendor/nelmio/alice/src/Generator/Resolver/Value/Chainable/FixtureReferenceResolver.php';
include_once $this->targetDirs[3].'/vendor/nelmio/alice/src/Generator/Resolver/Value/Chainable/FixtureWildcardReferenceResolver.php';
include_once $this->targetDirs[3].'/vendor/nelmio/alice/src/Generator/Resolver/Value/Chainable/ListValueResolver.php';
include_once $this->targetDirs[3].'/vendor/nelmio/alice/src/Generator/Resolver/Value/Chainable/OptionalValueResolver.php';
include_once $this->targetDirs[3].'/vendor/nelmio/alice/src/Generator/Resolver/Value/Chainable/ParameterValueResolver.php';
include_once $this->targetDirs[3].'/vendor/nelmio/alice/src/Generator/Resolver/Value/Chainable/UniqueValueResolver.php';
include_once $this->targetDirs[3].'/vendor/nelmio/alice/src/Generator/Resolver/UniqueValuesPool.php';
include_once $this->targetDirs[3].'/vendor/nelmio/alice/src/Generator/Resolver/Value/Chainable/ValueForCurrentValueResolver.php';
include_once $this->targetDirs[3].'/vendor/nelmio/alice/src/Generator/Resolver/Value/Chainable/VariableValueResolver.php';
include_once $this->targetDirs[3].'/vendor/nelmio/alice/src/Generator/InstantiatorInterface.php';
include_once $this->targetDirs[3].'/vendor/nelmio/alice/src/Generator/Instantiator/ExistingInstanceInstantiator.php';
include_once $this->targetDirs[3].'/vendor/nelmio/alice/src/Generator/Instantiator/InstantiatorResolver.php';
include_once $this->targetDirs[3].'/vendor/nelmio/alice/src/Generator/Instantiator/InstantiatorRegistry.php';
include_once $this->targetDirs[3].'/vendor/nelmio/alice/src/Generator/Instantiator/ChainableInstantiatorInterface.php';
include_once $this->targetDirs[3].'/vendor/nelmio/alice/src/Generator/Instantiator/Chainable/AbstractChainableInstantiator.php';
include_once $this->targetDirs[3].'/vendor/nelmio/alice/src/Generator/Instantiator/Chainable/NoCallerMethodCallInstantiator.php';
include_once $this->targetDirs[3].'/vendor/nelmio/alice/src/Generator/Instantiator/Chainable/NullConstructorInstantiator.php';
include_once $this->targetDirs[3].'/vendor/nelmio/alice/src/Generator/Instantiator/Chainable/NoMethodCallInstantiator.php';
include_once $this->targetDirs[3].'/vendor/nelmio/alice/src/Generator/Instantiator/Chainable/StaticFactoryInstantiator.php';
include_once $this->targetDirs[3].'/vendor/symfony/dependency-injection/ContainerAwareInterface.php';
include_once $this->targetDirs[3].'/vendor/hautelook/alice-bundle/src/Alice/Generator/Instantiator/Chainable/InstantiatedReferenceInstantiator.php';
include_once $this->targetDirs[3].'/vendor/nelmio/alice/src/Generator/HydratorInterface.php';
include_once $this->targetDirs[3].'/vendor/nelmio/alice/src/Generator/Hydrator/SimpleHydrator.php';
include_once $this->targetDirs[3].'/vendor/nelmio/alice/src/Generator/Hydrator/PropertyHydratorInterface.php';
include_once $this->targetDirs[3].'/vendor/nelmio/alice/src/Generator/Hydrator/Property/SymfonyPropertyAccessorHydrator.php';
include_once $this->targetDirs[3].'/vendor/nelmio/alice/src/Generator/CallerInterface.php';
include_once $this->targetDirs[3].'/vendor/nelmio/alice/src/Generator/Caller/SimpleCaller.php';
include_once $this->targetDirs[3].'/vendor/nelmio/alice/src/Generator/Caller/CallProcessorInterface.php';
include_once $this->targetDirs[3].'/vendor/nelmio/alice/src/Generator/Caller/CallProcessorRegistry.php';
include_once $this->targetDirs[3].'/vendor/nelmio/alice/src/Generator/Caller/ChainableCallProcessorInterface.php';
include_once $this->targetDirs[3].'/vendor/nelmio/alice/src/Generator/Caller/CallProcessorAwareInterface.php';
include_once $this->targetDirs[3].'/vendor/nelmio/alice/src/Generator/Caller/Chainable/ConfiguratorMethodCallProcessor.php';
include_once $this->targetDirs[3].'/vendor/nelmio/alice/src/Generator/Caller/Chainable/MethodCallWithReferenceProcessor.php';
include_once $this->targetDirs[3].'/vendor/nelmio/alice/src/Generator/Caller/Chainable/OptionalMethodCallProcessor.php';
include_once $this->targetDirs[3].'/vendor/nelmio/alice/src/Generator/Caller/Chainable/SimpleMethodCallProcessor.php';

$a = new \Nelmio\Alice\FixtureBuilder\Denormalizer\FlagParser\ElementFlagParser(new \Nelmio\Alice\FixtureBuilder\Denormalizer\FlagParser\FlagParserRegistry(array(0 => new \Nelmio\Alice\FixtureBuilder\Denormalizer\FlagParser\Chainable\ConfiguratorFlagParser(), 1 => new \Nelmio\Alice\FixtureBuilder\Denormalizer\FlagParser\Chainable\ExtendFlagParser(), 2 => new \Nelmio\Alice\FixtureBuilder\Denormalizer\FlagParser\Chainable\OptionalFlagParser(), 3 => new \Nelmio\Alice\FixtureBuilder\Denormalizer\FlagParser\Chainable\TemplateFlagParser(), 4 => new \Nelmio\Alice\FixtureBuilder\Denormalizer\FlagParser\Chainable\UniqueFlagParser())));
$b = new \Nelmio\Alice\FixtureBuilder\ExpressionLanguage\Parser\TokenParser\Chainable\ArgumentEscaper();

$c = new \Nelmio\Alice\FixtureBuilder\Denormalizer\Fixture\SpecificationBagDenormalizer\Value\UniqueValueDenormalizer(new \Nelmio\Alice\FixtureBuilder\Denormalizer\Fixture\SpecificationBagDenormalizer\Value\SimpleValueDenormalizer(new \Nelmio\Alice\FixtureBuilder\ExpressionLanguage\Parser\FunctionFixtureReferenceParser(new \Nelmio\Alice\FixtureBuilder\ExpressionLanguage\Parser\StringMergerParser(new \Nelmio\Alice\FixtureBuilder\ExpressionLanguage\Parser\SimpleParser(new \Nelmio\Alice\FixtureBuilder\ExpressionLanguage\Lexer\EmptyValueLexer(new \Nelmio\Alice\FixtureBuilder\ExpressionLanguage\Lexer\ReferenceEscaperLexer(new \Nelmio\Alice\FixtureBuilder\ExpressionLanguage\Lexer\GlobalPatternsLexer(new \Nelmio\Alice\FixtureBuilder\ExpressionLanguage\Lexer\FunctionLexer(new \Nelmio\Alice\FixtureBuilder\ExpressionLanguage\Lexer\StringThenReferenceLexer(new \Nelmio\Alice\FixtureBuilder\ExpressionLanguage\Lexer\SubPatternsLexer(new \Nelmio\Alice\FixtureBuilder\ExpressionLanguage\Lexer\ReferenceLexer())))))), new \Nelmio\Alice\FixtureBuilder\ExpressionLanguage\Parser\TokenParser\TokenParserRegistry(array(0 => new \Nelmio\Alice\FixtureBuilder\ExpressionLanguage\Parser\TokenParser\Chainable\DynamicArrayTokenParser(), 1 => new \Nelmio\Alice\FixtureBuilder\ExpressionLanguage\Parser\TokenParser\Chainable\EscapedValueTokenParser(), 2 => new \Nelmio\Alice\FixtureBuilder\ExpressionLanguage\Parser\TokenParser\Chainable\FixtureListReferenceTokenParser(), 3 => new \Nelmio\Alice\FixtureBuilder\ExpressionLanguage\Parser\TokenParser\Chainable\FixtureMethodReferenceTokenParser(), 4 => new \Nelmio\Alice\FixtureBuilder\ExpressionLanguage\Parser\TokenParser\Chainable\FixtureRangeReferenceTokenParser(), 5 => new \Nelmio\Alice\FixtureBuilder\ExpressionLanguage\Parser\TokenParser\Chainable\MethodReferenceTokenParser(), 6 => new \Nelmio\Alice\FixtureBuilder\ExpressionLanguage\Parser\TokenParser\Chainable\OptionalTokenParser(), 7 => new \Nelmio\Alice\FixtureBuilder\ExpressionLanguage\Parser\TokenParser\Chainable\ParameterTokenParser(), 8 => new \Nelmio\Alice\FixtureBuilder\ExpressionLanguage\Parser\TokenParser\Chainable\PropertyReferenceTokenParser(), 9 => new \Nelmio\Alice\FixtureBuilder\ExpressionLanguage\Parser\TokenParser\Chainable\VariableReferenceTokenParser(), 10 => new \Nelmio\Alice\FixtureBuilder\ExpressionLanguage\Parser\TokenParser\Chainable\SimpleReferenceTokenParser(), 11 => new \Nelmio\Alice\FixtureBuilder\ExpressionLanguage\Parser\TokenParser\Chainable\StringArrayTokenParser(), 12 => new \Nelmio\Alice\FixtureBuilder\ExpressionLanguage\Parser\TokenParser\Chainable\StringTokenParser($b), 13 => new \Nelmio\Alice\FixtureBuilder\ExpressionLanguage\Parser\TokenParser\Chainable\TolerantFunctionTokenParser(new \Nelmio\Alice\FixtureBuilder\ExpressionLanguage\Parser\TokenParser\Chainable\IdentityTokenParser(new \Nelmio\Alice\FixtureBuilder\ExpressionLanguage\Parser\TokenParser\Chainable\FunctionTokenParser($b))), 14 => new \Nelmio\Alice\FixtureBuilder\ExpressionLanguage\Parser\TokenParser\Chainable\VariableTokenParser(), 15 => new \Nelmio\Alice\FixtureBuilder\ExpressionLanguage\Parser\TokenParser\Chainable\WildcardReferenceTokenParser())))))));

$d = new \Nelmio\Alice\FixtureBuilder\Denormalizer\Fixture\SpecificationBagDenormalizer\Arguments\SimpleArgumentsDenormalizer($c);
$e = new \Nelmio\Alice\FixtureBuilder\Denormalizer\Fixture\SpecificationBagDenormalizer\Calls\CallsWithFlagsDenormalizer(new \Nelmio\Alice\FixtureBuilder\Denormalizer\Fixture\SpecificationBagDenormalizer\Calls\FunctionDenormalizer($d), array(0 => new \Nelmio\Alice\FixtureBuilder\Denormalizer\Fixture\SpecificationBagDenormalizer\Calls\MethodFlagHandler\ConfiguratorFlagHandler(), 1 => new \Nelmio\Alice\FixtureBuilder\Denormalizer\Fixture\SpecificationBagDenormalizer\Calls\MethodFlagHandler\OptionalFlagHandler()));

$f = new \Nelmio\Alice\FixtureBuilder\Denormalizer\Fixture\SpecificationBagDenormalizer\SimpleSpecificationsDenormalizer(new \Nelmio\Alice\FixtureBuilder\Denormalizer\Fixture\SpecificationBagDenormalizer\Constructor\LegacyConstructorDenormalizer(new \Nelmio\Alice\FixtureBuilder\Denormalizer\Fixture\SpecificationBagDenormalizer\Constructor\ConstructorDenormalizer($d), new \Nelmio\Alice\FixtureBuilder\Denormalizer\Fixture\SpecificationBagDenormalizer\Constructor\FactoryDenormalizer($e)), new \Nelmio\Alice\FixtureBuilder\Denormalizer\Fixture\SpecificationBagDenormalizer\Property\SimplePropertyDenormalizer($c), $e);
$g = new \Nelmio\Alice\PropertyAccess\StdPropertyAccessor(($this->privates['property_accessor'] ?? $this->getPropertyAccessorService()));

$h = new \Nelmio\Alice\Generator\Resolver\Value\ValueResolverRegistry(array(0 => new \Nelmio\Alice\Generator\Resolver\Value\Chainable\ArrayValueResolver(), 1 => new \Nelmio\Alice\Generator\Resolver\Value\Chainable\DynamicArrayValueResolver(), 2 => new \Nelmio\Alice\Generator\Resolver\Value\Chainable\EvaluatedValueResolver(), 3 => new \Nelmio\Alice\Generator\Resolver\Value\Chainable\FunctionCallArgumentResolver(new \Nelmio\Alice\Generator\Resolver\Value\Chainable\PhpFunctionCallValueResolver($this->parameters['nelmio_alice.functions_blacklist'], new \Nelmio\Alice\Generator\Resolver\Value\Chainable\FakerFunctionCallValueResolver(($this->services['Faker\Generator'] ?? $this->load('getGeneratorService.php'))))), 4 => new \Nelmio\Alice\Generator\Resolver\Value\Chainable\FixturePropertyReferenceResolver($g), 5 => new \Nelmio\Alice\Generator\Resolver\Value\Chainable\FixtureMethodCallReferenceResolver(), 6 => new \Nelmio\Alice\Generator\Resolver\Value\Chainable\UnresolvedFixtureReferenceIdResolver(new \Nelmio\Alice\Generator\Resolver\Value\Chainable\SelfFixtureReferenceResolver(new \Nelmio\Alice\Generator\Resolver\Value\Chainable\FixtureReferenceResolver())), 7 => new \Nelmio\Alice\Generator\Resolver\Value\Chainable\FixtureWildcardReferenceResolver(), 8 => new \Nelmio\Alice\Generator\Resolver\Value\Chainable\ListValueResolver(), 9 => new \Nelmio\Alice\Generator\Resolver\Value\Chainable\OptionalValueResolver(), 10 => new \Nelmio\Alice\Generator\Resolver\Value\Chainable\ParameterValueResolver(), 11 => new \Nelmio\Alice\Generator\Resolver\Value\Chainable\UniqueValueResolver(new \Nelmio\Alice\Generator\Resolver\UniqueValuesPool(), NULL, 150), 12 => new \Nelmio\Alice\Generator\Resolver\Value\Chainable\ValueForCurrentValueResolver(), 13 => new \Nelmio\Alice\Generator\Resolver\Value\Chainable\VariableValueResolver()));
$i = new \Hautelook\AliceBundle\Alice\Generator\Instantiator\Chainable\InstantiatedReferenceInstantiator();
$i->setContainer($this);

return $this->services['nelmio_alice.data_loader'] = new \Nelmio\Alice\Loader\SimpleDataLoader(new \Nelmio\Alice\FixtureBuilder\SimpleBuilder(new \Nelmio\Alice\FixtureBuilder\Denormalizer\SimpleDenormalizer(new \Nelmio\Alice\FixtureBuilder\Denormalizer\Parameter\SimpleParameterBagDenormalizer(), new \Nelmio\Alice\FixtureBuilder\Denormalizer\Fixture\SimpleFixtureBagDenormalizer(new \Nelmio\Alice\FixtureBuilder\Denormalizer\Fixture\TolerantFixtureDenormalizer(new \Nelmio\Alice\FixtureBuilder\Denormalizer\Fixture\FixtureDenormalizerRegistry($a, array(0 => new \Nelmio\Alice\FixtureBuilder\Denormalizer\Fixture\Chainable\SimpleCollectionDenormalizer(new \Nelmio\Alice\FixtureBuilder\Denormalizer\Fixture\Chainable\CollectionDenormalizerWithTemporaryFixture(new \Nelmio\Alice\FixtureBuilder\Denormalizer\Fixture\Chainable\NullListNameDenormalizer())), 1 => new \Nelmio\Alice\FixtureBuilder\Denormalizer\Fixture\Chainable\ReferenceRangeNameDenormalizer($f), 2 => new \Nelmio\Alice\FixtureBuilder\Denormalizer\Fixture\Chainable\SimpleCollectionDenormalizer(new \Nelmio\Alice\FixtureBuilder\Denormalizer\Fixture\Chainable\CollectionDenormalizerWithTemporaryFixture(new \Nelmio\Alice\FixtureBuilder\Denormalizer\Fixture\Chainable\NullRangeNameDenormalizer())), 3 => new \Nelmio\Alice\FixtureBuilder\Denormalizer\Fixture\Chainable\SimpleDenormalizer($f)))), $a))), new \Nelmio\Alice\Generator\DoublePassGenerator(new \Nelmio\Alice\Generator\Resolver\FixtureSet\RemoveConflictingObjectsResolver(new \Nelmio\Alice\Generator\Resolver\FixtureSet\SimpleFixtureSetResolver(new \Nelmio\Alice\Generator\Resolver\Parameter\RemoveConflictingParametersParameterBagResolver(new \Nelmio\Alice\Generator\Resolver\Parameter\SimpleParameterBagResolver(new \Nelmio\Alice\Generator\Resolver\Parameter\ParameterResolverRegistry(array(0 => new \Nelmio\Alice\Generator\Resolver\Parameter\Chainable\StaticParameterResolver(), 1 => new \Nelmio\Alice\Generator\Resolver\Parameter\Chainable\ArrayParameterResolver(), 2 => new \Nelmio\Alice\Generator\Resolver\Parameter\Chainable\RecursiveParameterResolver(new \Nelmio\Alice\Generator\Resolver\Parameter\Chainable\StringParameterResolver(), 5))))), new \Nelmio\Alice\Generator\Resolver\Fixture\TemplateFixtureBagResolver())), new \Nelmio\Alice\Generator\ObjectGenerator\CompleteObjectGenerator(new \Nelmio\Alice\Generator\ObjectGenerator\SimpleObjectGenerator($h, new \Nelmio\Alice\Generator\Instantiator\ExistingInstanceInstantiator(new \Nelmio\Alice\Generator\Instantiator\InstantiatorResolver(new \Nelmio\Alice\Generator\Instantiator\InstantiatorRegistry(array(0 => new \Nelmio\Alice\Generator\Instantiator\Chainable\NoCallerMethodCallInstantiator(), 1 => new \Nelmio\Alice\Generator\Instantiator\Chainable\NullConstructorInstantiator(), 2 => new \Nelmio\Alice\Generator\Instantiator\Chainable\NoMethodCallInstantiator(), 3 => new \Nelmio\Alice\Generator\Instantiator\Chainable\StaticFactoryInstantiator(), 4 => $i)))), new \Nelmio\Alice\Generator\Hydrator\SimpleHydrator(new \Nelmio\Alice\Generator\Hydrator\Property\SymfonyPropertyAccessorHydrator($g)), new \Nelmio\Alice\Generator\Caller\SimpleCaller(new \Nelmio\Alice\Generator\Caller\CallProcessorRegistry(array(0 => new \Nelmio\Alice\Generator\Caller\Chainable\ConfiguratorMethodCallProcessor(), 1 => new \Nelmio\Alice\Generator\Caller\Chainable\MethodCallWithReferenceProcessor(), 2 => new \Nelmio\Alice\Generator\Caller\Chainable\OptionalMethodCallProcessor(), 3 => new \Nelmio\Alice\Generator\Caller\Chainable\SimpleMethodCallProcessor())), $h)))));
