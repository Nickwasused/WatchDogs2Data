import AsyncImage from '../../asyncimage.js';

const Vehicleobject = ({name}) => {
    return (
        <tr>
            <td>
            <p>{name}</p>
            </td>
            <td>
                <AsyncImage src={"images/webp/vehicles/" + name + ".webp"}/>
            </td>
        </tr>
  );
};

export default Vehicleobject