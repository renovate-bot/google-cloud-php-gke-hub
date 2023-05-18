<?php
/*
 * Copyright 2023 Google LLC
 *
 * Licensed under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License.
 * You may obtain a copy of the License at
 *
 *     https://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS,
 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 * See the License for the specific language governing permissions and
 * limitations under the License.
 */

/*
 * GENERATED CODE WARNING
 * Generated by gapic-generator-php from the file
 * https://github.com/googleapis/googleapis/blob/master/google/cloud/gkehub/v1/service.proto
 * Updates to the above are reflected here through a refresh process.
 */

namespace Google\Cloud\GkeHub\V1\Client\BaseClient;

use Google\ApiCore\ApiException;
use Google\ApiCore\CredentialsWrapper;
use Google\ApiCore\GapicClientTrait;
use Google\ApiCore\LongRunning\OperationsClient;
use Google\ApiCore\OperationResponse;
use Google\ApiCore\PagedListResponse;
use Google\ApiCore\ResourceHelperTrait;
use Google\ApiCore\RetrySettings;
use Google\ApiCore\Transport\TransportInterface;
use Google\ApiCore\ValidationException;
use Google\Auth\FetchAuthTokenInterface;
use Google\Cloud\GkeHub\V1\CreateFeatureRequest;
use Google\Cloud\GkeHub\V1\CreateMembershipRequest;
use Google\Cloud\GkeHub\V1\DeleteFeatureRequest;
use Google\Cloud\GkeHub\V1\DeleteMembershipRequest;
use Google\Cloud\GkeHub\V1\Feature;
use Google\Cloud\GkeHub\V1\GenerateConnectManifestRequest;
use Google\Cloud\GkeHub\V1\GenerateConnectManifestResponse;
use Google\Cloud\GkeHub\V1\GetFeatureRequest;
use Google\Cloud\GkeHub\V1\GetMembershipRequest;
use Google\Cloud\GkeHub\V1\ListFeaturesRequest;
use Google\Cloud\GkeHub\V1\ListMembershipsRequest;
use Google\Cloud\GkeHub\V1\Membership;
use Google\Cloud\GkeHub\V1\UpdateFeatureRequest;
use Google\Cloud\GkeHub\V1\UpdateMembershipRequest;
use Google\LongRunning\Operation;
use GuzzleHttp\Promise\PromiseInterface;

/**
 * Service Description: The GKE Hub service handles the registration of many Kubernetes clusters to
 * Google Cloud, and the management of multi-cluster features over those
 * clusters.
 *
 * The GKE Hub service operates on the following resources:
 *
 * * [Membership][google.cloud.gkehub.v1.Membership]
 * * [Feature][google.cloud.gkehub.v1.Feature]
 *
 * GKE Hub is currently available in the global region and all regions in
 * https://cloud.google.com/compute/docs/regions-zones. Feature is only
 * available in global region while membership is global region and all the
 * regions.
 *
 * **Membership management may be non-trivial:** it is recommended to use one
 * of the Google-provided client libraries or tools where possible when working
 * with Membership resources.
 *
 * This class provides the ability to make remote calls to the backing service through method
 * calls that map to API methods.
 *
 * Many parameters require resource names to be formatted in a particular way. To
 * assist with these names, this class includes a format method for each type of
 * name, and additionally a parseName method to extract the individual identifiers
 * contained within formatted names that are returned by the API.
 *
 * This class is currently experimental and may be subject to changes.
 *
 * @experimental
 *
 * @internal
 *
 * @method PromiseInterface createFeatureAsync(CreateFeatureRequest $request, array $optionalArgs = [])
 * @method PromiseInterface createMembershipAsync(CreateMembershipRequest $request, array $optionalArgs = [])
 * @method PromiseInterface deleteFeatureAsync(DeleteFeatureRequest $request, array $optionalArgs = [])
 * @method PromiseInterface deleteMembershipAsync(DeleteMembershipRequest $request, array $optionalArgs = [])
 * @method PromiseInterface generateConnectManifestAsync(GenerateConnectManifestRequest $request, array $optionalArgs = [])
 * @method PromiseInterface getFeatureAsync(GetFeatureRequest $request, array $optionalArgs = [])
 * @method PromiseInterface getMembershipAsync(GetMembershipRequest $request, array $optionalArgs = [])
 * @method PromiseInterface listFeaturesAsync(ListFeaturesRequest $request, array $optionalArgs = [])
 * @method PromiseInterface listMembershipsAsync(ListMembershipsRequest $request, array $optionalArgs = [])
 * @method PromiseInterface updateFeatureAsync(UpdateFeatureRequest $request, array $optionalArgs = [])
 * @method PromiseInterface updateMembershipAsync(UpdateMembershipRequest $request, array $optionalArgs = [])
 */
abstract class GkeHubBaseClient
{
    use GapicClientTrait;
    use ResourceHelperTrait;

    /** The name of the service. */
    private const SERVICE_NAME = 'google.cloud.gkehub.v1.GkeHub';

    /** The default address of the service. */
    private const SERVICE_ADDRESS = 'gkehub.googleapis.com';

    /** The default port of the service. */
    private const DEFAULT_SERVICE_PORT = 443;

    /** The name of the code generator, to be included in the agent header. */
    private const CODEGEN_NAME = 'gapic';

    /** The default scopes required by the service. */
    public static $serviceScopes = [
        'https://www.googleapis.com/auth/cloud-platform',
    ];

    private $operationsClient;

    private static function getClientDefaults()
    {
        return [
            'serviceName' => self::SERVICE_NAME,
            'apiEndpoint' => self::SERVICE_ADDRESS . ':' . self::DEFAULT_SERVICE_PORT,
            'clientConfig' => __DIR__ . '/../../resources/gke_hub_client_config.json',
            'descriptorsConfigPath' => __DIR__ . '/../../resources/gke_hub_descriptor_config.php',
            'gcpApiConfigPath' => __DIR__ . '/../../resources/gke_hub_grpc_config.json',
            'credentialsConfig' => [
                'defaultScopes' => self::$serviceScopes,
            ],
            'transportConfig' => [
                'rest' => [
                    'restClientConfigPath' => __DIR__ . '/../../resources/gke_hub_rest_client_config.php',
                ],
            ],
        ];
    }

    /**
     * Return an OperationsClient object with the same endpoint as $this.
     *
     * @return OperationsClient
     */
    public function getOperationsClient()
    {
        return $this->operationsClient;
    }

    /**
     * Resume an existing long running operation that was previously started by a long
     * running API method. If $methodName is not provided, or does not match a long
     * running API method, then the operation can still be resumed, but the
     * OperationResponse object will not deserialize the final response.
     *
     * @param string $operationName The name of the long running operation
     * @param string $methodName    The name of the method used to start the operation
     *
     * @return OperationResponse
     */
    public function resumeOperation($operationName, $methodName = null)
    {
        $options = isset($this->descriptors[$methodName]['longRunning']) ? $this->descriptors[$methodName]['longRunning'] : [];
        $operation = new OperationResponse($operationName, $this->getOperationsClient(), $options);
        $operation->reload();
        return $operation;
    }

    /**
     * Formats a string containing the fully-qualified path to represent a feature
     * resource.
     *
     * @param string $project
     * @param string $location
     * @param string $feature
     *
     * @return string The formatted feature resource.
     */
    public static function featureName(string $project, string $location, string $feature): string
    {
        return self::getPathTemplate('feature')->render([
            'project' => $project,
            'location' => $location,
            'feature' => $feature,
        ]);
    }

    /**
     * Formats a string containing the fully-qualified path to represent a location
     * resource.
     *
     * @param string $project
     * @param string $location
     *
     * @return string The formatted location resource.
     */
    public static function locationName(string $project, string $location): string
    {
        return self::getPathTemplate('location')->render([
            'project' => $project,
            'location' => $location,
        ]);
    }

    /**
     * Formats a string containing the fully-qualified path to represent a membership
     * resource.
     *
     * @param string $project
     * @param string $location
     * @param string $membership
     *
     * @return string The formatted membership resource.
     */
    public static function membershipName(string $project, string $location, string $membership): string
    {
        return self::getPathTemplate('membership')->render([
            'project' => $project,
            'location' => $location,
            'membership' => $membership,
        ]);
    }

    /**
     * Parses a formatted name string and returns an associative array of the components in the name.
     * The following name formats are supported:
     * Template: Pattern
     * - feature: projects/{project}/locations/{location}/features/{feature}
     * - location: projects/{project}/locations/{location}
     * - membership: projects/{project}/locations/{location}/memberships/{membership}
     *
     * The optional $template argument can be supplied to specify a particular pattern,
     * and must match one of the templates listed above. If no $template argument is
     * provided, or if the $template argument does not match one of the templates
     * listed, then parseName will check each of the supported templates, and return
     * the first match.
     *
     * @param string $formattedName The formatted name string
     * @param string $template      Optional name of template to match
     *
     * @return array An associative array from name component IDs to component values.
     *
     * @throws ValidationException If $formattedName could not be matched.
     */
    public static function parseName(string $formattedName, string $template = null): array
    {
        return self::parseFormattedName($formattedName, $template);
    }

    /**
     * Constructor.
     *
     * @param array $options {
     *     Optional. Options for configuring the service API wrapper.
     *
     *     @type string $apiEndpoint
     *           The address of the API remote host. May optionally include the port, formatted
     *           as "<uri>:<port>". Default 'gkehub.googleapis.com:443'.
     *     @type string|array|FetchAuthTokenInterface|CredentialsWrapper $credentials
     *           The credentials to be used by the client to authorize API calls. This option
     *           accepts either a path to a credentials file, or a decoded credentials file as a
     *           PHP array.
     *           *Advanced usage*: In addition, this option can also accept a pre-constructed
     *           {@see \Google\Auth\FetchAuthTokenInterface} object or
     *           {@see \Google\ApiCore\CredentialsWrapper} object. Note that when one of these
     *           objects are provided, any settings in $credentialsConfig will be ignored.
     *     @type array $credentialsConfig
     *           Options used to configure credentials, including auth token caching, for the
     *           client. For a full list of supporting configuration options, see
     *           {@see \Google\ApiCore\CredentialsWrapper::build()} .
     *     @type bool $disableRetries
     *           Determines whether or not retries defined by the client configuration should be
     *           disabled. Defaults to `false`.
     *     @type string|array $clientConfig
     *           Client method configuration, including retry settings. This option can be either
     *           a path to a JSON file, or a PHP array containing the decoded JSON data. By
     *           default this settings points to the default client config file, which is
     *           provided in the resources folder.
     *     @type string|TransportInterface $transport
     *           The transport used for executing network requests. May be either the string
     *           `rest` or `grpc`. Defaults to `grpc` if gRPC support is detected on the system.
     *           *Advanced usage*: Additionally, it is possible to pass in an already
     *           instantiated {@see \Google\ApiCore\Transport\TransportInterface} object. Note
     *           that when this object is provided, any settings in $transportConfig, and any
     *           $apiEndpoint setting, will be ignored.
     *     @type array $transportConfig
     *           Configuration options that will be used to construct the transport. Options for
     *           each supported transport type should be passed in a key for that transport. For
     *           example:
     *           $transportConfig = [
     *               'grpc' => [...],
     *               'rest' => [...],
     *           ];
     *           See the {@see \Google\ApiCore\Transport\GrpcTransport::build()} and
     *           {@see \Google\ApiCore\Transport\RestTransport::build()} methods for the
     *           supported options.
     *     @type callable $clientCertSource
     *           A callable which returns the client cert as a string. This can be used to
     *           provide a certificate and private key to the transport layer for mTLS.
     * }
     *
     * @throws ValidationException
     */
    public function __construct(array $options = [])
    {
        $clientOptions = $this->buildClientOptions($options);
        $this->setClientOptions($clientOptions);
        $this->operationsClient = $this->createOperationsClient($clientOptions);
    }

    /** Handles execution of the async variants for each documented method. */
    public function __call($method, $args)
    {
        if (substr($method, -5) !== 'Async') {
            trigger_error('Call to undefined method ' . __CLASS__ . "::$method()", E_USER_ERROR);
        }

        array_unshift($args, substr($method, 0, -5));
        return call_user_func_array([$this, 'startAsyncCall'], $args);
    }

    /**
     * Adds a new Feature.
     *
     * The async variant is {@see self::createFeatureAsync()} .
     *
     * @param CreateFeatureRequest $request     A request to house fields associated with the call.
     * @param array                $callOptions {
     *     Optional.
     *
     *     @type RetrySettings|array $retrySettings
     *           Retry settings to use for this call. Can be a {@see RetrySettings} object, or an
     *           associative array of retry settings parameters. See the documentation on
     *           {@see RetrySettings} for example usage.
     * }
     *
     * @return OperationResponse
     *
     * @throws ApiException Thrown if the API call fails.
     */
    public function createFeature(CreateFeatureRequest $request, array $callOptions = []): OperationResponse
    {
        return $this->startApiCall('CreateFeature', $request, $callOptions)->wait();
    }

    /**
     * Creates a new Membership.
     *
     * **This is currently only supported for GKE clusters on Google Cloud**.
     * To register other clusters, follow the instructions at
     * https://cloud.google.com/anthos/multicluster-management/connect/registering-a-cluster.
     *
     * The async variant is {@see self::createMembershipAsync()} .
     *
     * @param CreateMembershipRequest $request     A request to house fields associated with the call.
     * @param array                   $callOptions {
     *     Optional.
     *
     *     @type RetrySettings|array $retrySettings
     *           Retry settings to use for this call. Can be a {@see RetrySettings} object, or an
     *           associative array of retry settings parameters. See the documentation on
     *           {@see RetrySettings} for example usage.
     * }
     *
     * @return OperationResponse
     *
     * @throws ApiException Thrown if the API call fails.
     */
    public function createMembership(CreateMembershipRequest $request, array $callOptions = []): OperationResponse
    {
        return $this->startApiCall('CreateMembership', $request, $callOptions)->wait();
    }

    /**
     * Removes a Feature.
     *
     * The async variant is {@see self::deleteFeatureAsync()} .
     *
     * @param DeleteFeatureRequest $request     A request to house fields associated with the call.
     * @param array                $callOptions {
     *     Optional.
     *
     *     @type RetrySettings|array $retrySettings
     *           Retry settings to use for this call. Can be a {@see RetrySettings} object, or an
     *           associative array of retry settings parameters. See the documentation on
     *           {@see RetrySettings} for example usage.
     * }
     *
     * @return OperationResponse
     *
     * @throws ApiException Thrown if the API call fails.
     */
    public function deleteFeature(DeleteFeatureRequest $request, array $callOptions = []): OperationResponse
    {
        return $this->startApiCall('DeleteFeature', $request, $callOptions)->wait();
    }

    /**
     * Removes a Membership.
     *
     * **This is currently only supported for GKE clusters on Google Cloud**.
     * To unregister other clusters, follow the instructions at
     * https://cloud.google.com/anthos/multicluster-management/connect/unregistering-a-cluster.
     *
     * The async variant is {@see self::deleteMembershipAsync()} .
     *
     * @param DeleteMembershipRequest $request     A request to house fields associated with the call.
     * @param array                   $callOptions {
     *     Optional.
     *
     *     @type RetrySettings|array $retrySettings
     *           Retry settings to use for this call. Can be a {@see RetrySettings} object, or an
     *           associative array of retry settings parameters. See the documentation on
     *           {@see RetrySettings} for example usage.
     * }
     *
     * @return OperationResponse
     *
     * @throws ApiException Thrown if the API call fails.
     */
    public function deleteMembership(DeleteMembershipRequest $request, array $callOptions = []): OperationResponse
    {
        return $this->startApiCall('DeleteMembership', $request, $callOptions)->wait();
    }

    /**
     * Generates the manifest for deployment of the GKE connect agent.
     *
     * **This method is used internally by Google-provided libraries.**
     * Most clients should not need to call this method directly.
     *
     * The async variant is {@see self::generateConnectManifestAsync()} .
     *
     * @param GenerateConnectManifestRequest $request     A request to house fields associated with the call.
     * @param array                          $callOptions {
     *     Optional.
     *
     *     @type RetrySettings|array $retrySettings
     *           Retry settings to use for this call. Can be a {@see RetrySettings} object, or an
     *           associative array of retry settings parameters. See the documentation on
     *           {@see RetrySettings} for example usage.
     * }
     *
     * @return GenerateConnectManifestResponse
     *
     * @throws ApiException Thrown if the API call fails.
     */
    public function generateConnectManifest(GenerateConnectManifestRequest $request, array $callOptions = []): GenerateConnectManifestResponse
    {
        return $this->startApiCall('GenerateConnectManifest', $request, $callOptions)->wait();
    }

    /**
     * Gets details of a single Feature.
     *
     * The async variant is {@see self::getFeatureAsync()} .
     *
     * @param GetFeatureRequest $request     A request to house fields associated with the call.
     * @param array             $callOptions {
     *     Optional.
     *
     *     @type RetrySettings|array $retrySettings
     *           Retry settings to use for this call. Can be a {@see RetrySettings} object, or an
     *           associative array of retry settings parameters. See the documentation on
     *           {@see RetrySettings} for example usage.
     * }
     *
     * @return Feature
     *
     * @throws ApiException Thrown if the API call fails.
     */
    public function getFeature(GetFeatureRequest $request, array $callOptions = []): Feature
    {
        return $this->startApiCall('GetFeature', $request, $callOptions)->wait();
    }

    /**
     * Gets the details of a Membership.
     *
     * The async variant is {@see self::getMembershipAsync()} .
     *
     * @param GetMembershipRequest $request     A request to house fields associated with the call.
     * @param array                $callOptions {
     *     Optional.
     *
     *     @type RetrySettings|array $retrySettings
     *           Retry settings to use for this call. Can be a {@see RetrySettings} object, or an
     *           associative array of retry settings parameters. See the documentation on
     *           {@see RetrySettings} for example usage.
     * }
     *
     * @return Membership
     *
     * @throws ApiException Thrown if the API call fails.
     */
    public function getMembership(GetMembershipRequest $request, array $callOptions = []): Membership
    {
        return $this->startApiCall('GetMembership', $request, $callOptions)->wait();
    }

    /**
     * Lists Features in a given project and location.
     *
     * The async variant is {@see self::listFeaturesAsync()} .
     *
     * @param ListFeaturesRequest $request     A request to house fields associated with the call.
     * @param array               $callOptions {
     *     Optional.
     *
     *     @type RetrySettings|array $retrySettings
     *           Retry settings to use for this call. Can be a {@see RetrySettings} object, or an
     *           associative array of retry settings parameters. See the documentation on
     *           {@see RetrySettings} for example usage.
     * }
     *
     * @return PagedListResponse
     *
     * @throws ApiException Thrown if the API call fails.
     */
    public function listFeatures(ListFeaturesRequest $request, array $callOptions = []): PagedListResponse
    {
        return $this->startApiCall('ListFeatures', $request, $callOptions);
    }

    /**
     * Lists Memberships in a given project and location.
     *
     * The async variant is {@see self::listMembershipsAsync()} .
     *
     * @param ListMembershipsRequest $request     A request to house fields associated with the call.
     * @param array                  $callOptions {
     *     Optional.
     *
     *     @type RetrySettings|array $retrySettings
     *           Retry settings to use for this call. Can be a {@see RetrySettings} object, or an
     *           associative array of retry settings parameters. See the documentation on
     *           {@see RetrySettings} for example usage.
     * }
     *
     * @return PagedListResponse
     *
     * @throws ApiException Thrown if the API call fails.
     */
    public function listMemberships(ListMembershipsRequest $request, array $callOptions = []): PagedListResponse
    {
        return $this->startApiCall('ListMemberships', $request, $callOptions);
    }

    /**
     * Updates an existing Feature.
     *
     * The async variant is {@see self::updateFeatureAsync()} .
     *
     * @param UpdateFeatureRequest $request     A request to house fields associated with the call.
     * @param array                $callOptions {
     *     Optional.
     *
     *     @type RetrySettings|array $retrySettings
     *           Retry settings to use for this call. Can be a {@see RetrySettings} object, or an
     *           associative array of retry settings parameters. See the documentation on
     *           {@see RetrySettings} for example usage.
     * }
     *
     * @return OperationResponse
     *
     * @throws ApiException Thrown if the API call fails.
     */
    public function updateFeature(UpdateFeatureRequest $request, array $callOptions = []): OperationResponse
    {
        return $this->startApiCall('UpdateFeature', $request, $callOptions)->wait();
    }

    /**
     * Updates an existing Membership.
     *
     * The async variant is {@see self::updateMembershipAsync()} .
     *
     * @param UpdateMembershipRequest $request     A request to house fields associated with the call.
     * @param array                   $callOptions {
     *     Optional.
     *
     *     @type RetrySettings|array $retrySettings
     *           Retry settings to use for this call. Can be a {@see RetrySettings} object, or an
     *           associative array of retry settings parameters. See the documentation on
     *           {@see RetrySettings} for example usage.
     * }
     *
     * @return OperationResponse
     *
     * @throws ApiException Thrown if the API call fails.
     */
    public function updateMembership(UpdateMembershipRequest $request, array $callOptions = []): OperationResponse
    {
        return $this->startApiCall('UpdateMembership', $request, $callOptions)->wait();
    }
}
