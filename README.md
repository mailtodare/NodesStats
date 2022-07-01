# NodesStats
<!-- TABLE OF CONTENTS -->
<details>
  <summary>Table of Contents</summary>
  <ol>
    <li>
      <a href="#about-the-project">About The Project</a>
    </li>
    <li>
      <a href="#thought-process">Thought Process</a>
      <ul>
        <li><a href="#summary-of-models">Summary of Models</a></li>
        <li><a href="#nodes-characteristics">Nodes Characteristics</a></li>        
        <li><a href="#implementation">Test Implementation</a></li>
       <li><a href="#navigation">Navigation</a></li>       
      </ul>
    </li>
</details>

## About The Project

NodeStats is an API to handle nodes statistics. Several node points connected to the API relay their system info to it for necessary centralized management purposes. 

## Thought Process

The nodes can be of different types e.g. IoT nodes. In this test, with no specific type of nodes specified, web points were considered. Therefore, web forms will be used to mock nodes operations. Laravel will be used to develop the solution. 
    
Every node first needs to be registered before its entries can be processed, and for necessary authentication and authorisation. Node entities will be modelled to “Node” with corresponding “nodes” table with fields. If every node has its admin, which must first be authenticated before granting access to create node account.
    
There should be a Super Admin who will have access to all nodes or group of nodes. This admin will be able to view all logged nodes stats and filter for specific node(s). Should be able to delete node(s) account(s) which will delete all the nodes references in the database. Set purge time, hourly scheduling of nodes entry starts with purge.

  <p align="right">(<a href="#top">back to top</a>)</p>

### Summary of Models

#### Node

* Fields: `node_name`, `node_description`, `password`, (other node’s parameters), `admin_id`, `created_at`.
* Operations: create account, edit account, make entry, view own entries, logout

#### Node Entry

* Fields: ID, `comment`, `ram_use`, `disk_used`.
* Operations: Create, view, paginate, delete,

#### Node Admin

* Fields: name, username | email, password
* Operations: create admin account, create and manage node account – performs all of Node’s operations for the manged node.

#### System Admin

* Fields: name, username | email, password
* Operations: with super privilege – create other admins accounts, authorize nodes (set permissions, delete), view all nodes entries, set environment variables (e.g. prune time)

  <p align="right">(<a href="#top">back to top</a>)</p>
  
### Nodes characteristics | Assumptions

*	Same parameters should not be expected from Nodes as they might not be of same type and user.
*	Individual Node properties/specifications will be fairly unchanged overtime.
*	Node’s entry data may be best stored in a single Json column. This will reduce number of unique columns that have to be created for different nodes that will share same table together. 
*	Similar json column may be used for json Node entities too, for their system specifications. This will equally reduce number of unique columns while permitting different properties to be stored..
*	•	Due to nodes uniqueness, their entries should come at their own designated time. But the test may use the server schedule times to request entries from nodes.
  
  <p align="right">(<a href="#top">back to top</a>)</p>

### Implementation

Node admin may not be implemented in this test exercise, Node account will serve as its admin account. Only one System admin is recognised.

An unauthenticated node will be redirected to login page and will only be able to access other unprotected routes.

Upon successful login or registration; jwt token will be generated, included with `id` (might include other node basic parameters, expiration, …), sent to the node to be included in subsequent requests.

Authenticated Node will have access to relay its stats to NodeStats, view previous logs within the set pruning timeframe. And can logout its session.

### Navigation
#### No authenticated user recognised: 

*	Redirect to index page – with links.

#### Authenticated user
##### Is Node
* Redirect to Create New Node page.
* Can log stats, edit Node parameters, view previous logs, logout.
* Can only manage one node. So once created, access to creation page is prevented.
* Can not see logs of other nodes.

##### Is Admin
* Redirect to Admin landing page. Can `view logs`, `delete nodes | logs`, `logout`.
  
  <p align="right">(<a href="#top">back to top</a>)</p>
    
## Implemented
The app presents a landing page accessible to all guests, only. Protected routes [ create new node, node dashboard, admin dashboard] were adequately protected.
Some validation logistics were implemented to ensure some measure of relativity of the expected data.
    
The Node total disk value is used as reference to evaluate other numerical properties. Max expected values of other three parameters are set thus; Allocated Disk is set at 75%, Total Ram is 15% while Allocated Ram is 75% of Total Ram.
    
Pagination of result set is set at 10 entries per page.
    
As at time of reporting, the “schedule” of Console Kernel is yet to be perfected. While it schedules as desired, the tasks attached were not accordingly implemented.
    
Docker-compose yml file requested is yet to be ready, as I struggled with its implementation. I had challenge making it run as the application runs on outside the container for my dependencies versions.
    
## Scalability

The app will scale by the number of nodes connected to it, its qualitative relevance in system management, amount of diagnosis it runs, its reporting methodologies among others.
The application should be able to deal with various data that will be feed to it at little or no additional development overhead. That’s, it must be agile to accept different data sets. Its data storage must be efficiently setup to cope with high traffics at low latency.

